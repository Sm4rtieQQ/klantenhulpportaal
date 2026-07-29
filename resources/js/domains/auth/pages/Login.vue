<script setup lang="ts">
import { ref } from 'vue';
import axios from 'axios';
import FormError from '@/services/error/FormError.vue';
import { getErrorBag, getMessage } from '@/services/error';

const form = ref({ email: '', password: '' });

const logIn = async (data: any) => {

    try {
        await axios.get('/sanctum/csrf-cookie');
        const response = await axios.post('/api/login', data);
        console.log('Succesvol ingelogd', response.config.data);
    } catch (error: any) {
        if (error.response) {
            console.error(`Login niet succesvol (${error.response.status})`, error.response.data);
        }
    }
}

</script>

<template>
    <div v-if="getMessage">{{ getMessage }}</div>

    <form class="grid bg-amber-200 mx-auto max-w-80 p-8" @submit.prevent="logIn(form)">
        <div class="grid grid-cols-[80px_auto] gap-2 mb-2">

            <label class="text-right" for="email">Email</label>
            <div>
                <input class="max-w-42 bg-amber-50 w-full" name="email" id="email" type="email" v-model="form.email" />
            </div>


            <label class="text-right" for="password">Password</label>
            <input class="max-w-42 bg-amber-50 w-full" name="password" id="password" type="password"
                v-model="form.password" />
        </div>
        <button type="submit">Inloggen!</button>
    </form>
</template>