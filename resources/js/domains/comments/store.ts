import { storeModuleFactory } from "@/services/store";

const commentStore = storeModuleFactory('comments');

export const loadComments = async () => {
    await commentStore.actions.getAll();
}

export const getTicketComments = async (ticketId: number) => {
    return await commentStore.actions.getByForeignId('ticket', ticketId);
}