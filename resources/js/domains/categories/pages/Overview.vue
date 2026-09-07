<script setup lang="ts">
import { onMounted } from 'vue';
import { categoriesInitialized, deleteCategory, getCategoriesSortedBy, loadCategories } from '../store';
import ErrorMessage from '@/services/error/ErrorMessage.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

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
        <a @click="router.push({ name: 'categories.create' })" class="font-semibold text-sm">Nieuwe categorie</a>
        <table>
            <thead>
                <tr>
                    <th>Categorie</th>
                    <th>Bewerken</th>
                    <th>Aantal tickets</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!categoriesInitialized">
                    <td colspan="3">Categorieën worden geladen...</td>
                </tr>
                <tr v-else-if="categories.length === 0">
                    <td colspan="3">Geen categorieën gevonden.</td>
                </tr>
                <tr v-else v-for="category in categories" :key="category.id">
                    <td>{{ category.name }}</td>
                    <td class="grid text-xs font-semibold space-y-1">
                        <a @click="router.push({ name: 'categories.edit', params: { id: category.id } })"
                            class="cursor-pointer">Bewerken</a>
                        <a @click="deleteCategory(category.id)" class="text-red-700 cursor-pointer">Verwijderen</a>
                    </td>
                    <td>{{ category.entries }}</td>
                </tr>
            </tbody>
        </table>
        <ErrorMessage />
    </div>
</template>