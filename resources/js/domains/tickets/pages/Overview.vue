<script setup lang="ts">
import { ticketsInitialized, loadTickets, getTicketsSortedBy } from '../store';
import ErrorMessage from '@/services/error/ErrorMessage.vue';
import { onMounted } from 'vue';
import { formatDate } from '@/helpers/formatters';

onMounted(async () => {
    if (!ticketsInitialized.value) {
        await loadTickets();
    }
});

const tickets = getTicketsSortedBy('updated_at', false);
const getCategories = (ticket: any) => {
    return ticket.categories.map((c: any) => c.name).join(', ');
}
</script>

<template>
    <h1>Tickets:</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Categoriën</th>
                <th>Status</th>
                <th>Aangemaakt door:</th>
                <th>Toegewezen aan:</th>
                <th>Laatste update</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!ticketsInitialized">
                <td colspan="7">Tickets worden geladen...</td>
            </tr>
            <tr v-else-if="tickets.length === 0">
                <td colspan="7">Geen tickets gevonden.</td>
            </tr>
            <tr v-else v-for="ticket in tickets" :key="ticket.id" class="cursor-pointer group" @click="$router.push({
                name: 'tickets.show',
                params: { id: ticket.id }
            })">
                <td class="group-hover:bg-black/8">{{ ticket.id }}</td>
                <td class="group-hover:bg-black/8">{{ ticket.title }}</td>
                <td class="group-hover:bg-black/8">{{ getCategories(ticket) }}</td>
                <td class="group-hover:bg-black/8">{{ ticket.status_description }}</td>
                <td class="group-hover:bg-black/8">{{ ticket.created_by }}</td>
                <td class="group-hover:bg-black/8">{{ ticket.assigned_to }}</td>
                <td class="group-hover:bg-black/8 text-sm">{{ formatDate(ticket.updated_at) }}</td>
            </tr>
        </tbody>
    </table>

    <ErrorMessage />
</template>
