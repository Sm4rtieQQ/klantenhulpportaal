<script setup lang="ts">
import { ref } from 'vue';
import { admins } from '@/domains/users/store.js';
import { useAuth } from '@/domains/auth/store';
import { getCategoriesSortedBy } from '@/domains/categories/store';
import type { Ticket } from '@/helpers/types';
import FormError from '@/services/error/FormError.vue';

const { isAdmin } = useAuth();

const props = defineProps<{ ticket: Partial<Ticket> }>();

const emit = defineEmits(['submit']);

const form = ref({
    ...props.ticket,
    'categories': props.ticket.categories?.map(category => category.id),
});

const categories = getCategoriesSortedBy('name', true);

const handleSubmit = () => emit('submit', form.value)
</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid gap-4">
        <fieldset class="grid">
            <label for=" title">Titel</label>
            <FormError name="title" />
            <input id="title" v-model="form.title" type="text" />

            <label for="body">Omschrijving</label>
            <FormError name="body" />
            <textarea id="body" v-model="form.body" class="min-h-50"></textarea>
        </fieldset>

        <fieldset class="flexbox space-x-4 border border-gray-300 p-2">
            <legend>Categoriën</legend>
            <label v-for="category in categories" :key="category.id" :for="`category-${category.id}`">
                <input :id="`category-${category.id}`" type="checkbox" :value="category.id" v-model="form.categories" />
                {{ category.name }}
            </label>
        </fieldset>

        <fieldset v-if="isAdmin()" class="grid border border-gray-300 p-2">
            <legend>Admin-only</legend>
            <label for="assigned_to">Toegewezen aan</label>
            <select id="assigned_to" v-model="form.assigned_to_id">
                <option v-for="admin in admins" :key="admin.id" :value="admin.id">
                    {{ admin.name }} {{ admin.surname }}
                </option>
            </select>
            <label for="status">Status</label>
            <select id="status" v-model="form.status">
                <option value="1">new</option>
                <option value="2">pending</option>
                <option value="3">in_progress</option>
                <option value="4">completed</option>
                <option value="5">abandoned</option>
            </select>
        </fieldset>

        <h5>Aangemaakt door: {{ form.created_by }}</h5>
        <button type="submit">Opslaan</button>
    </form>

</template>