import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';
import { authRoutes } from '../domains/auth/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [...ticketRoutes, ...authRoutes],
});