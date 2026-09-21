<script setup lang="ts">
import { postRequest } from '@/services/http';
import { useAuth } from '../store';
import { ref } from 'vue';

const { user } = useAuth();

const message = ref();

const resendVerificationEmail = async () => {
    const response = await postRequest('/email/verification-notification', null);
    message.value = response.data.message;
}
</script>

<template>
    <div v-if="user" class="fixed wrap max-w-[500px] top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <h1>Bevestig uw emailadres</h1>
        <p>Er is een email verstuurd naar <strong>{{ user.email }}</strong>. Klik de link in de mail om uw email adres
            te bevestigen.</p>
        <p class="text-xs">Klik <a @click="resendVerificationEmail()"
                class="cursor-pointer font-bold hover:underline">hier</a> voor een
            nieuwe link</p>
        <span class="message">{{ message }}</span>
    </div>
</template>
