import ForgotPassword from "./pages/ForgotPassword.vue";
import Login from "./pages/Login.vue";
import PasswordReset from "./pages/PasswordReset.vue";
import Register from "./pages/Register.vue";
import VerifyEmail from "./pages/VerifyEmail.vue";

export const authRoutes = [
    { path: '/login', component: Login, name: 'auth.login' },
    { path: '/register', component: Register, name: 'auth.register' },
    { path: '/email/verify', component: VerifyEmail, name: 'auth.verify' },
    { path: '/email/forgot-password', component: ForgotPassword, name: 'auth.forgot-password' },
    { path: '/email/new-password/:token?', component: PasswordReset, name: 'auth.new-password' },
];