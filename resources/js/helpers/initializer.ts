import { useAuth } from "@/domains/auth/store";
import { categoriesInitialized, loadCategories } from "@/domains/categories/store";
import { ticketsInitialized, loadTickets, getTicket } from "@/domains/tickets/store";
import { adminsInitialized, loadAdmins } from "@/domains/users/store";

const { isAdmin } = useAuth();

export function initializer() {
    const initializeAdmins = async () => {
        if (isAdmin()) {
            !adminsInitialized.value ? await loadAdmins() : null;
        }
    }

    const initializeCategories = async () => {
        if (isAdmin()) {
            !categoriesInitialized.value ? await loadCategories() : null;
        }
    }

    const initializeTickets = async () => {
        !ticketsInitialized.value ? await loadTickets() : null;
    }

    return {
        initializeAdmins,
        initializeCategories,
        initializeTickets,
    }
}