import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';
import { serviceRoutes } from '@/services/routes';
import { categoryRoutes } from '@/domains/categories/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...categoryRoutes,
        ...ticketRoutes,
        ...serviceRoutes,
    ],
});
