<script setup lang="ts">
import { useRouter } from 'vue-router';
import { getTicketsSortedBy } from '../store';

const router = useRouter();

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
            <tr v-for="ticket in tickets" :key="ticket.id">
                <router-link :to="{ name: 'tickets.show', params: { id: ticket.id } }" class="contents">
                    <td>{{ ticket.id }}</td>
                    <td>{{ ticket.title }}</td>
                    <td>{{ getCategories(ticket) }}</td>
                    <td>{{ ticket.status }}</td>
                    <td>{{ ticket.created_by }}</td>
                    <td>{{ ticket.assigned_to }}</td>
                    <td class="text-sm">{{ ticket.updated_at }}</td>
                </router-link>
            </tr>
        </tbody>
    </table>
</template>
