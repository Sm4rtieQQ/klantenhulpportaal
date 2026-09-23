<script setup lang="ts">
import { getRouter } from '@/router/instance';
import ErrorMessage from '@/services/error/ErrorMessage.vue';
import FormError from '@/services/error/FormError.vue';
import { computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import { resetPassword } from '../store';

const router = getRouter();
const route = useRoute();

const token = computed(() => String(route.params.token ?? route.query.token ?? ''));
const email = computed(() => String(route.query.email ?? ''));

const form = ref({
    password: '',
    password_confirmation: '',
});

const handleReset = async () => {
    const data = {
        token: token.value,
        email: email.value,
        password: form.value.password,
        password_confirmation: form.value.password_confirmation,
    };

    await resetPassword(data);

    router.push({ name: 'auth.login' });
}
</script>


<template>
    <div class="fixed left-1/2 -translate-x-1/2 top-40 w-full max-w-100">
        <div class="wrap">
            <form @submit.prevent="handleReset">
                <h1>Nieuw wachtwoord</h1>
                <p class="mb-4">Reset voor {{ email }}</p>
                <div class="grid grid-cols-[120px_auto] gap-y-2">

                    <label for="password">Wachtwoord</label>
                    <div>
                        <FormError name="password" />
                        <input id="password" v-model="form.password" type="password">
                    </div>

                    <label for="password_confirmation">Wachtwoord bevestigen</label>
                    <div>
                        <FormError name="password_confirmation" />
                        <input id="password_confirmation" v-model="form.password_confirmation" type="password">
                    </div>
                </div>
                <ErrorMessage />
                <button type="submit">Opslaan</button>
            </form>
        </div>
    </div>

</template>