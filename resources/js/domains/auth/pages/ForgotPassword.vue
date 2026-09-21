<script setup lang="ts">
import { getRouter } from '@/router/instance';
import FormError from '@/services/error/FormError.vue';
import { postRequest } from '@/services/http';
import { ref } from 'vue';

const router = getRouter();

const submitted = ref(false);

const form = ref({
    email: ''
});

const sendPasswordResetEmail = async () => {
    try {
        await postRequest('/forgot-password', form.value);
        submitted.value = true;
    } catch {
        //
    }
}
</script>


<template>
    <div class="fixed left-1/2 -translate-x-1/2 top-40 w-full max-w-100">
        <div v-if="!submitted" class="wrap">
            <form @submit.prevent="sendPasswordResetEmail">
                <h1>Wachtwoord vergeten</h1>
                <div class="grid grid-cols-[120px_auto] gap-y-2">

                    <label for="email">Email</label>
                    <div>
                        <FormError name="email" />
                        <input id="email" v-model="form.email">
                    </div>
                </div>
                <button type="submit">Stuur link</button>
            </form>
        </div>
        <div v-else class="wrap">
            <p>Er is een link verstuurd naar <strong>{{ form.email }}</strong>. Klik de link in de email om uw
                wachtwoord te resetten.</p>
        </div>
        <a @click="router.push({ name: 'auth.login' })" class="text-sm hover:underline cursor-pointer">Terug naar
            inlogpagina.</a>
    </div>

</template>
