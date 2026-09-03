<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { categoriesInitialized, getCategoriesSortedBy, loadCategories } from '../store';
import Form from '../components/Form.vue';

onMounted(async () => {
    if (!categoriesInitialized.value) {
        await loadCategories();
    }
})

const categories = getCategoriesSortedBy('name');

</script>

<template>
    <div class="w-auto mx-auto">
        <h1>Categoriën</h1>
        <table>
            <thead>
                <tr>
                    <th>Categorie</th>
                    <th>Aantal tickets</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!categoriesInitialized">
                    <td colspan="2">Categorieën worden geladen...</td>
                </tr>
                <tr v-else-if="categories.length === 0">
                    <td colspan="2">Geen categorieën gevonden.</td>
                </tr>
                <tr v-else v-for="category in categories" :key="category.id">
                    <td>{{ category.name }}</td>
                    <td>{{ category.entries }}</td>
                </tr>
            </tbody>
        </table>
        <Form />
    </div>
</template>