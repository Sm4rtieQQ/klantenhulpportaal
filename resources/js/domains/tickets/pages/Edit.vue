<script setup lang="ts">
import { useRoute, useRouter } from 'vue-router';
import Form from '../components/Form.vue';
import { getTicket } from '../store';

const route = useRoute();
const router = useRouter();

const ticketId = Number(route.params.id);

const ticket = getTicket(ticketId);

const handleSubmit = (ticket: any) => {
    router.push({ name: 'tickets.show', params: { id: ticket.id } });
}
</script>

<template>
    <h2>Bewerk ticket</h2>
    <Form v-if="ticket" :ticket="ticket" @submit="handleSubmit" />
</template>