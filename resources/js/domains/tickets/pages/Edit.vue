<script setup lang="ts">
import { useRoute, useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { getTicket, loadTickets, updateTicket } from '../store';
import { onMounted, ref } from 'vue';
import { useAuth } from '@/domains/auth/store.js';
import { initializer } from '@/helpers/initializer.js';

const { user } = useAuth();

const route = useRoute();
const router = useRouter();
const { initializeAdmins, initializeTickets } = initializer();

const ticketId = Number(route.params.id);

let ticket = getTicket(ticketId);

const existingTicket = ref({
    'title': ticket.value.title,
    'body': ticket.value.body,
    'status': ticket.value.status,
    'created_by_name': user.value?.name + ' ' + user.value?.surname,
    'created_by_id': user.value?.id,
    'assigned_to_name': ticket.value.assigned_to,
    'assigned_to_id': ticket.value.assigned_to_id,
})

const handleSubmit = async (data: any) => {
    await updateTicket(ticketId, data);
    await loadTickets();
    router.push({ name: 'tickets.show', params: { id: ticketId } });
}

onMounted(async () => {
    initializeAdmins();
    initializeTickets();
});
</script>

<template>
    <h2>Bewerk ticket</h2>
    <Form v-if="ticket" :ticket="existingTicket" @submit="handleSubmit" />
</template>