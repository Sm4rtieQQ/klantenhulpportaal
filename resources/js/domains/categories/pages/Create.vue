<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { Category } from '@/helpers/types.js';
import { addCategory } from '../store.js';
import { getRouter } from '@/router/instance.js';

const router = getRouter();

const newCategory = ref<Partial<Category>>({
    'name': '',
})

const handleSubmit = async (data: any) => {
    await addCategory(data);
    router.push({ name: 'categories.overview' });
}

</script>

<template>
    <Form :category="newCategory" @submit="handleSubmit" />
</template>