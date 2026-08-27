<script setup lang="ts">
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';
import { router } from '@/router/index.js';

const emit = defineEmits(['submit']);

const form = ref({
    email: '',
    password: '',
});

const handleSubmit = async () => {
    emit('submit', form.value)
    router.push({ name: 'tickets.overview' });
}

</script>

<template>
    <div class="max-w-[500px] grid min-h-screen pt-4 content-center mx-auto">
        <form @submit.prevent="handleSubmit" class="wrap">
            <div class="grid grid-cols-[120px_auto] gap-2 mb-2">
                <label for="email">Email</label>
                <div>
                    <input id="email" v-model="form.email">
                    <FormError name="email" />
                </div>
                <label for="password">Wachtwoord</label>
                <div>
                    <input id="password" type="password" v-model="form.password">
                    <FormError name="password" />
                </div>
            </div>
            <button type="submit">Inloggen</button>
        </form>
    </div>
</template>
