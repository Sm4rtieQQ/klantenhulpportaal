import { useAuth } from "@/domains/auth/store";
import { categoriesInitialized, loadCategories } from "@/domains/categories/store";
import { ticketsInitialized, loadTickets } from "@/domains/tickets/store";
import { adminsInitialized, loadAdmins, loadUsers, usersInitialized } from "@/domains/users/store";

const { isAdmin } = useAuth();

export function initializer() {
    const initializeAdmins = async () => {
        if (isAdmin()) {
            !adminsInitialized.value ? await loadAdmins() : null;
        }
    }

    const initializeCategories = async () => {
        !categoriesInitialized.value ? await loadCategories() : null;
    }

    const initializeTickets = async () => {
        !ticketsInitialized.value ? await loadTickets() : null;
    }

    const initializeUsers = async () => {
        !usersInitialized.value ? await loadUsers() : null;
    }

    return {
        initializeAdmins,
        initializeCategories,
        initializeTickets,
        initializeUsers,
    }
}