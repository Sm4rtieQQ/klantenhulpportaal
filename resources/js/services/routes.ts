import Error_403 from './error/403.vue';
import Error_404 from './error/404.vue';

export const serviceRoutes = [
    { path: '/403', component: Error_403, name: 'error.403' },
    { path: '/:pathMatch(.*)*', component: Error_404, name: 'error.404' },
]