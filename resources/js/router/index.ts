import { createRouter, createWebHistory } from 'vue-router';
import { ticketRoutes } from '../domains/tickets/routes';
import { serviceRoutes } from '@/services/routes';
import { categoryRoutes } from '@/domains/categories/routes';
import { userRoutes } from '@/domains/users/routes';
import { authRoutes } from '@/domains/auth/routes';
import { useAuth } from '@/domains/auth/store';

const { authInitialized, initializeAuth, isLoggedIn, isVerified } = useAuth();

const publicRouteNames = new Set([
    'auth.login',
    'auth.register',
    'auth.forgot-password',
    'auth.new-password',
])

export const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', redirect: { name: 'tickets.overview' } },

        ...authRoutes,
        ...categoryRoutes,
        ...ticketRoutes,
        ...serviceRoutes,
        ...userRoutes,
    ],
});

router.beforeEach(async to => {
    if (!authInitialized.value) await initializeAuth();

    const isPublicRoute = typeof to.name === 'string' && publicRouteNames.has(to.name);
    const isVerifyRoute = to.name === 'auth.verify';

    if (isLoggedIn()) {
        if (!isVerified.value && !isVerifyRoute) {
            return { name: 'auth.verify' }
        }

        if (!isPublicRoute) return true;
        return { name: 'tickets.overview' }
    }

    if (isPublicRoute) return true;

    return { name: 'auth.login' }
});
