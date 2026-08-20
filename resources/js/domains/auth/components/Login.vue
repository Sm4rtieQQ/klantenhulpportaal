<script setup lang="ts">
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';

const emit = defineEmits(['submit']);

const form = ref({
    email: '',
    password: '',
});

const handleSubmit = () => emit('submit', form.value);

</script>

<template>
    <div class="max-w-[500px] mx-auto pt-4">
        <form @submit.prevent="handleSubmit">
            <div class="grid grid-cols-[120px_auto] gap-2 mb-2">
                <label class="font-semibold" for="email">Email</label>
                <div>
                    <input class="bg-white" name="email" type="email" v-model="form.email">
                    <FormError name="email" />
                </div>
                <label class="font-semibold" for="password">Wachtwoord</label>
                <div>
                    <input class="bg-white" name="password" type="password" v-model="form.password">
                    <FormError name="password" />
                </div>
            </div>
            <button type="submit">Inloggen</button>
        </form>
    </div>
</template>
