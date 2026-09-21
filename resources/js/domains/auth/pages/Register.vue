<script setup lang="ts">
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';
import { register } from '../store';
import { getRouter } from '@/router/instance';

const router = getRouter();

const form = ref([
    {
        id: 0,
        value: '',
        name: 'name',
        type: 'text',
        description: 'Naam',
    },
    {
        id: 1,
        value: '',
        name: 'surname',
        type: 'text',
        description: 'Achternaam',
    },
    {
        id: 2,
        value: '',
        name: 'email',
        type: 'email',
        description: 'Email',
    },
    {
        id: 3,
        value: '',
        name: 'role',
        type: 'text',
        description: 'Rol',
    },
    {
        id: 4,
        value: '',
        name: 'tel',
        type: 'text',
        description: 'Telefoonnummer',
    },
    {
        id: 5,
        value: '',
        name: 'password',
        type: 'password',
        description: 'Wachtwoord',
    },
    {
        id: 6,
        value: '',
        name: 'password_confirmation',
        type: 'password',
        description: 'Wachtwoord bevestigen',
    },
]);

const submitForm = async () => {
    const data = Object.fromEntries(
        form.value.map(({ name, value }) => [name, value])
    );
    await register(data);
    router.push({ name: 'auth.login' });
}
</script>

<template>
    <div class="fixed left-1/2 -translate-x-1/2 top-40 w-full max-w-100">
        <form @submit.prevent="submitForm" class="wrap">
            <h1>Registreren</h1>
            <div class="grid gap-y-2">
                <div v-for="field in form" :key="field.id" class="grid grid-cols-[150px_auto]">
                    <label :for="field.name">{{ field.description }}</label>
                    <div>
                        <FormError :name="field.name" />
                        <input v-model="field.value" :id="field.name" :name="field.name" :type="field.type" />
                    </div>
                </div>
            </div>
            <button type="submit">Registreren</button>
        </form>
        <p class="text-sm">
            Heb je al een account? Klik
            <a class="font-semibold cursor-pointer hover:underline active:font-slate-800"
                @click="router.push({ name: 'auth.login' })">hier</a>
            om in te loggen.
        </p>
    </div>
</template>