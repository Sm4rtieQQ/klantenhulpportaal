import { storeModuleFactory } from "@/services/store";
import { ComputedRef } from "vue";
import type { Comment } from "@/helpers/types";

const commentStore = storeModuleFactory('comments');

export const loadComments = async () => {
    await commentStore.actions.getAll();
}

export const comments = commentStore.getters.all;

export const clearComments = () => {
    commentStore.setters.clear();
}

export const getComment = (id: number) => {
    return commentStore.getters.getById(id);
}

export const getTicketComments = async (ticketId: number) => {
    return await commentStore.actions.getByFields({ ticket_id: ticketId }) ?? [];
}

export const getCommentsSortedBy = (columnName: string, asc: boolean): ComputedRef<Comment[]> => {
    return commentStore.getters.sortedByField(columnName, asc) as ComputedRef<Comment[]>;
}

export const addComment = async (newComment: Comment) => {
    await commentStore.actions.create(newComment);
}

export const updateComment = async (id: number, updatedComment: Comment) => {
    await commentStore.actions.update(id, updatedComment);
}

export const deleteComment = async (id: number) => {
    await commentStore.actions.delete(id);
}