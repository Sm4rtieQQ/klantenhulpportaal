import { storeModuleFactory } from "@/services/store";

const commentStore = storeModuleFactory('comments');

commentStore.actions.getAll();

export const getTicketComments = (ticketId: number) => {
    return commentStore.actions.getByFields({ ticket_id: ticketId }) ?? [];
}