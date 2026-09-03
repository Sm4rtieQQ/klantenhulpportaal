<script setup lang="ts">
import { ref } from 'vue';
import { addCategory } from '../store';
import FormError from '@/services/error/FormError.vue';

const newCategory = ref({ 'name': '', })

const handleSubmit = async () => {
    await addCategory(newCategory.value);
    newCategory.value.name = ''
}
</script>

<template>
    <form @submit.prevent="handleSubmit" class="my-4 grid">
        <label for="name">Nieuwe categorie</label>
        <input type="text" id="name" v-model="newCategory.name" />
        <FormError name="name" />
        <button type="submit" class="my-4">Opslaan</button>
    </form>
</template>