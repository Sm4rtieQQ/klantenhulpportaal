import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';
import { serviceRoutes } from '@/services/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...ticketRoutes,
        ...serviceRoutes,
    ],
});
