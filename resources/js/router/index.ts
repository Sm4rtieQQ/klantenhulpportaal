import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';
import { serviceRoutes } from '@/services/routes';
import { categoryRoutes } from '@/domains/categories/routes';
import { userRoutes } from '@/domains/users/routes';
import { authRoutes } from '@/domains/auth/routes';

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        ...authRoutes,
        ...categoryRoutes,
        ...ticketRoutes,
        ...serviceRoutes,
        ...userRoutes,
    ],
});
