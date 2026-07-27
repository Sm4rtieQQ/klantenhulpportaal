import { ComputedRef } from "vue";
import { storeModuleFactory } from "../../services/store";
import type { Ticket } from "../../types";

const ticketStore = storeModuleFactory('tickets');

ticketStore.actions.getAll();

export const tickets = ticketStore.getters.all;

export const getTicketsSortedBy = (ColumnName: string): ComputedRef<Ticket[]> => {
    return ticketStore.getters.sortedBy(ColumnName) as ComputedRef<Ticket[]>;
}
