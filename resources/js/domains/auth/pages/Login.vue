<script setup lang="ts">
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';
import ErrorMessage from '@/services/error/ErrorMessage.vue';
import { useAuth } from '../store';
import { getRouter } from '@/router/instance';

const router = getRouter();

const { login } = useAuth();

const form = ref({
    email: '',
    password: '',
});

const handleLogin = async () => {
    await login(form.value);
    router.push({ name: 'tickets.overview' });
}

</script>

<template>
    <div class="fixed left-1/2 -translate-x-1/2 top-40 w-full max-w-100">
        <form @submit.prevent="handleLogin" class="wrap">
            <h1>Inloggen</h1>
            <div class="grid grid-cols-[120px_auto] gap-y-2">

                <label for="email">Email</label>
                <div>
                    <FormError name="email" />
                    <input id="email" v-model="form.email">
                </div>

                <label for="password">Wachtwoord</label>
                <div>
                    <FormError name="password" />
                    <input id="password" type="password" v-model="form.password" style="margin-bottom: 0">
                    <a class="block text-xs cursor-pointer hover:underline"
                        @click="router.push({ name: 'auth.forgot-password' })">Wachtwoord vergeten?</a>
                </div>

            </div>
            <ErrorMessage />
            <button type="submit">Inloggen</button>
        </form>

        <p class="text-sm">
            Geen account? Klik
            <a class="font-semibold cursor-pointer hover:underline active:font-slate-800"
                @click="router.push({ name: 'auth.register' })">hier</a>
            om te registreren.
        </p>
    </div>
</template>
