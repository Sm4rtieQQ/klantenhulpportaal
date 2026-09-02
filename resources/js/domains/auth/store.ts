import { ref } from "vue";
import type { User } from "@/helpers/types";
import { clearComments } from "@/domains/comments/store";
import { clearNotes } from "@/domains/notes/store";
import { clearTickets } from "@/domains/tickets/store";
import { getRequest, postRequest } from "@/services/http";
import { clearUsers } from "../users/store";

const user = ref<User | null>(null);
const authInitialized = ref(false);

export function useAuth() {
    const initializeAuth = async () => {
        try {
            const response = await getRequest('/user');
            user.value = response.data;
            console.log(`Succevol ingelogd als ${user.value?.name} ${user.value?.surname}`);
        } catch (error: any) {
            if (error.response?.status === 401) {
                user.value = null;
                console.error('Niet ingelogd.');
            } else {
                console.error(error)
            }
        } finally {
            authInitialized.value = true;
        }
    }

    const login = async (credentials: any) => {
        await getRequest('/sanctum/csrf-cookie');
        await postRequest('/login', credentials);

        const response = await getRequest('/user');
        user.value = response.data;
    }

    const logout = async () => {
        try {
            await postRequest('/logout', {});
            console.log('Uitgelogd');
        } finally {
            clearTickets();
            clearComments();
            clearNotes();
            clearUsers();
            user.value = null;
        }
    }

    return {
        user,
        authInitialized,
        isLoggedIn: () => !!user.value,
        isAdmin: () => user.value?.admin ?? false,
        initializeAuth,
        login,
        logout,
    }
}