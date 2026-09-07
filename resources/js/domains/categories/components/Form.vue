<script setup lang="ts">
import { ref } from 'vue';
import FormError from '@/services/error/FormError.vue';
import type { Category } from '@/helpers/types';

const props = defineProps<{ category: Partial<Category> }>();
const form = ref({ ...props.category });

const emit = defineEmits(['submit']);

const handleSubmit = async () => {
    emit('submit', form.value);
}
</script>

<template>
    <form @submit.prevent="handleSubmit" class="my-4 grid max-w-64 mx-auto">
        <input type="text" id="name" v-model="form.name" />
        <button type="submit" class="my-4">Opslaan</button>
        <FormError name="name" />
    </form>
</template>