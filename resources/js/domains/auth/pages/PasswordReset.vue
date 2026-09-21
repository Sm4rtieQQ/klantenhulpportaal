<script setup lang="ts">
import { getRouter } from '@/router/instance';
import ErrorMessage from '@/services/error/ErrorMessage.vue';
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';

const router = getRouter();

const submitted = ref(false);

const form = ref({
    password: '',
    password_confirmation: '',
});

const resetPassword = async () => {
    router.push({ name: 'auth.login' });
}
</script>


<template>
    <div class="fixed left-1/2 -translate-x-1/2 top-40 w-full max-w-100">
        <div class="wrap">
            <form @submit.prevent="resetPassword">
                <h1>Nieuw wachtwoord</h1>
                <div class="grid grid-cols-[120px_auto] gap-y-2">

                    <label for="password">Wachtwoord</label>
                    <div>
                        <FormError name="password" />
                        <input id="password" v-model="form.password">
                    </div>

                    <label for="password_confirmation">Wachtwoord bevestigen</label>
                    <div>
                        <FormError name="password_confirmation" />
                        <input id="password_confirmation" v-model="form.password_confirmation">
                    </div>
                </div>
                <ErrorMessage />
                <button type="submit">Stuur link</button>
            </form>
        </div>
    </div>

</template>