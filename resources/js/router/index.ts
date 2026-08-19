import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...ticketRoutes],
});