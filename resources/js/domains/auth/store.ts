import { Ref, ref } from "vue";
import axios from "axios";
import type { User } from "@/helpers/types";
import { clearComments } from "@/domains/comments/store";
import { clearNotes } from "@/domains/notes/store";
import { clearTickets } from "@/domains/tickets/store";

const user: Ref<User> | Ref<null> = ref(null);
const authInitialized = ref(false);

export function useAuth() {
    const initializeAuth = async () => {
        try {
            await axios.get('/sanctum/csrf-cookie');

            const response = await axios.get('/api/user');
            user.value = response.data;
            console.log('Succevol ingelogd.', user.value);
        } catch (error: any) {
            if (error.response?.status === 401) {
                user.value = null;
                console.error('Niet ingelogd.', error.response);
            } else {
                console.error(error)
            }
        } finally {
            authInitialized.value = true;
        }
    }

    const login = async (credentials: any) => {
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/api/login', credentials);

        const response = await axios.get('/api/user');
        user.value = response.data;
    }

    const logout = async () => {
        try {
            await axios.post('/api/logout');
            console.log('Uitgelogd');
        } finally {
            clearTickets();
            clearComments();
            clearNotes();
            user.value = null;
        }
    }

    return {
        user,
        authInitialized,
        isLoggedIn: () => !!user.value,
        initializeAuth,
        login,
        logout,
    }
}