import { ComputedRef } from "vue";
import { storeModuleFactory } from "@/services/store";
import type { Ticket } from "@/types";

const ticketStore = storeModuleFactory('tickets');

export const tickets = ticketStore.getters.all;

export const loadTickets = async () => {
    await ticketStore.actions.getAll();
}

export const getTicketsSortedBy = (columnName: string, asc: boolean): ComputedRef<Ticket[]> => {
    return ticketStore.getters.sortedByField(columnName, asc) as ComputedRef<Ticket[]>;
}

export const getTicket = (id: number) => {
    return ticketStore.getters.getById(id);
}