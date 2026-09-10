import Overview from "./pages/Overview.vue";
import Edit from "./pages/Edit.vue";

export const userRoutes = [
    { path: '/users', component: Overview, name: 'users.overview' },
    { path: '/users/:id', component: Edit, name: 'users.edit' },
]