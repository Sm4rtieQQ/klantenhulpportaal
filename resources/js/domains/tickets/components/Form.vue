<script setup lang="ts">
import { ref } from 'vue';
import { getAdminsSortedBy } from '@/domains/users/store.js';
import { useAuth } from '@/domains/auth/store';

const { isAdmin } = useAuth();

const props = defineProps({ ticket: Object });
const emit = defineEmits(['submit']);

const form = ref({ ...props.ticket, })
const admins = getAdminsSortedBy('surname', true);

const handleSubmit = () => emit('submit', form.value)
</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <label for="title">Titel</label>
        <input id="title" v-model="form.title" type="text" />

        <label for="body">Omschrijving</label>
        <textarea id="body" v-model="form.body" class="min-h-50"></textarea>

        <div v-if="isAdmin()" class="grid">
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
        </div>

        <h5>Aangemaakt door: {{ form.created_by }}</h5>
        <button type="submit">Opslaan</button>
    </form>

</template>