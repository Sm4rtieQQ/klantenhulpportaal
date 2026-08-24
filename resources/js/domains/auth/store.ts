import { Ref, ref } from "vue";
import axios from "axios";
import type { User } from "@/types";

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
        await axios.post('/api/logout');
        user.value = null;
        console.log('Uitgelogd.');
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