import { ComputedRef } from "vue";
import { storeModuleFactory } from "../../services/store";
import type { Ticket } from "../../types";

const ticketStore = storeModuleFactory('tickets');

ticketStore.actions.getAll();

export const tickets = ticketStore.getters.all;

export const getTicketsSortedBy = (columnName: string, asc: boolean): ComputedRef<Ticket[]> => {
    return ticketStore.getters.sortedBy(columnName, asc) as ComputedRef<Ticket[]>;
}

export const getTicket = (id: number) => {
    return ticketStore.getters.getById(id);
}