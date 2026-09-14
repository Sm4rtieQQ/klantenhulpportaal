<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuth } from '@/domains/auth/store'
import Form from '../components/Form.vue';
import { addTicket } from '../store.js';
import { initializer } from '@/helpers/initializer.js';
import type { Ticket } from '@/helpers/types.js';

const router = useRouter();
const { user } = useAuth();
const { initializeAdmins, initializeCategories } = initializer();

const newTicket = ref<Partial<Ticket>>({
    'title': '',
    'body': '',
    'status': 1,
    'created_by_id': user.value?.id,
    'assigned_to_id': null,
    'categories': [],
})

const handleSubmit = async (data: any) => {
    await addTicket(data);
    router.push({ name: 'tickets.overview' });
}

onMounted(() => {
    initializeAdmins();
    initializeCategories();
});
</script>

<template>
    <h2>Nieuw ticket</h2>
    <Form :ticket="newTicket" @submit="handleSubmit" />
</template>
