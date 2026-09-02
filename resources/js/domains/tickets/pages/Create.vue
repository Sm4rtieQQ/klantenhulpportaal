<script setup lang="ts">
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuth } from '@/domains/auth/store'
import Form from '../components/Form.vue';
import { addTicket } from '../store.js';

const router = useRouter();
const { user } = useAuth();

const newTicket = ref({
    'title': '',
    'body': '',
    'status': 'new',
    'created_by': user.value?.name + ' ' + user.value?.surname,
    'assigned_to': null,
})

const handleSubmit = async (data: any) => {
    await addTicket(data);
    router.push({ name: 'tickets.overview' });
}
</script>

<template>
    <h2>Nieuw ticket</h2>
    <Form :ticket="newTicket" @submit="handleSubmit" />
</template>
