<script setup lang="ts">
import { ref, computed } from 'vue';
import { getAdminsSortedBy } from '@/domains/users/store.js';
import { useAuth } from '@/domains/auth/store';

const props = defineProps({ ticket: Object });
const emit = defineEmits(['submit']);

const form = ref({ ...props.ticket })
const admins = getAdminsSortedBy('surname', true);

const { isAdmin } = useAuth();

const handleSubmit = () => emit('submit', form.value)

</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <label for="title">Titel</label>
        <input id="title" v-model="form.title" type="text" />

        <label for="body">Omschrijving</label>
        <textarea id="body" v-model="form.body" type="text" class="min-h-50"></textarea>

        <h5>Aangemaakt door: {{ form.created_by }}</h5>

        <label for="assigned_to">Toegewezen aan</label>
        <select id="assigned_to" v-model="form.assigned_to" :disabled="!isAdmin">
            <option disabled value="">Selecteer een gebruiker</option>
            <option v-for="admin in admins" :key="admin.id" :value="admin.id">
                {{ admin.name }} {{ admin.surname }}
            </option>
        </select>

        <button type="submit">Opslaan</button>
    </form>

</template>