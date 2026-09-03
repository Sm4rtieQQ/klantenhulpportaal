import { ComputedRef } from "vue";
import { storeModuleFactory } from "@/services/store";
import { ref } from "vue";
import type { Ticket } from "@/helpers/types";

const ticketStore = storeModuleFactory('tickets');
export const ticketsInitialized = ref(false);

export const loadTickets = async () => {
    await ticketStore.actions.getAll();
    ticketsInitialized.value = true;
}

export const tickets = ticketStore.getters.all;

export const clearTickets = () => {
    ticketStore.setters.clear();
    ticketsInitialized.value = false;
}

export const getTicketsSortedBy = (columnName: string, asc: boolean): ComputedRef<Ticket[]> => {
    return ticketStore.getters.sortedByField(columnName, asc) as ComputedRef<Ticket[]>;
}

export const getTicket = (id: number) => {
    return ticketStore.getters.getById(id);
}

export const addTicket = async (newTicket: Ticket) => {
    await ticketStore.actions.create(newTicket);
    ticketStore.actions.getAll();
}

export const updateTicket = async (id: number, updatedTicket: Ticket) => {
    await ticketStore.actions.update(id, updatedTicket);
    ticketStore.actions.getAll();
}