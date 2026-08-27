import { storeModuleFactory } from "@/services/store";
import { ComputedRef } from "vue";
import type { Note } from "@/helpers/types";

const noteStore = storeModuleFactory('notes');

export const loadNotes = async () => {
    await noteStore.actions.getAll();
}

export const notes = noteStore.getters.all;

export const clearNotes = () => {
    noteStore.setters.clear();
}

export const getTicketNotes = async (ticketId: number) => {
    return await noteStore.actions.getByFields({ ticket_id: ticketId }) ?? [];
}

export const getNotesSortedBy = (columnName: string, asc: boolean): ComputedRef<Note[]> => {
    return noteStore.getters.sortedByField(columnName, asc) as ComputedRef<Note[]>;
}