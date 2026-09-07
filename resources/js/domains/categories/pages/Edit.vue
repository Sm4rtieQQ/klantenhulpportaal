<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { getCategory, updateCategory } from '../store.js';
import { getRouter } from '@/router/instance.js';
import { useRoute } from 'vue-router';

const route = useRoute();
const router = getRouter();
const categoryId = Number(route.params.id);

const category = getCategory(categoryId);

const existingCategory = ref({
    'name': category.value.name,
})

const handleSubmit = async (data: any) => {
    await updateCategory(categoryId, data);
    router.push({ name: 'categories.overview' });
}


</script>

<template>
    <Form :category="existingCategory" @submit="handleSubmit" />
</template>