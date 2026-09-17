import Login from "./pages/Login.vue";
import Register from "./pages/Register.vue";
import VerifyEmail from "./pages/VerifyEmail.vue";

export const authRoutes = [
    { path: '/login', component: Login, name: 'auth.login' },
    { path: '/register', component: Register, name: 'auth.register' },
    { path: '/email/verify', component: VerifyEmail, name: 'auth.verify' },
];