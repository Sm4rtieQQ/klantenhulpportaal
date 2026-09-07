import Create from "./pages/Create.vue";
import Edit from "./pages/Edit.vue";
import Overview from "./pages/Overview.vue";

export const categoryRoutes = [
    { path: '/categories', component: Overview, name: 'categories.overview' },
    { path: '/categories/create', component: Create, name: 'categories.create' },
    { path: '/categories/:id/edit', component: Edit, name: 'categories.edit' },
]