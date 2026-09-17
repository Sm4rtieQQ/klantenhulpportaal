import { ref } from "vue";
import type { User } from "@/helpers/types";
import { clearComments } from "@/domains/comments/store";
import { clearNotes } from "@/domains/notes/store";
import { clearTickets } from "@/domains/tickets/store";
import { getRequest, postRequest } from "@/services/http";
import { clearUsers } from "../users/store";
import { clearCategories } from "../categories/store";
import { getRouter } from "@/router/instance";

const user = ref<User | null>(null);
const authInitialized = ref(false);

function loginMessage() {
    console.log(`Succevol ingelogd als ${user.value?.name} ${user.value?.surname}`);
}

export function useAuth() {
    const initializeAuth = async () => {
        try {
            const statusResponse = await getRequest('/auth/status');
            if (statusResponse.data.isLoggedIn) {
                const userResponse = await getRequest('/auth/user');
                user.value = userResponse.data;
                loginMessage();
            } else {
                user.value = null;
            }
        } finally {
            authInitialized.value = true;
        }
    }

    const login = async (credentials: any) => {
        await getRequest('/sanctum/csrf-cookie');

        const response = await postRequest('/auth/login', credentials);
        user.value = response.data.user;
        loginMessage();
    }

    const logout = async () => {
        await postRequest('/auth/logout', {});
        console.log('Uitgelogd');

        clearTickets();
        clearCategories();
        clearComments();
        clearNotes();
        clearUsers();
        user.value = null;
        initializeAuth();

        getRouter().push({ name: 'auth.login' });
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

export const register = async (data: any) => {
    await postRequest('/auth/register', data);
}