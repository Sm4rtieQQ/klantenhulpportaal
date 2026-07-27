<script setup lang="ts">
import { getTicketsSortedBy } from '../store';

const tickets = getTicketsSortedBy('created_at');

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
                <td>{{ ticket.id }}</td>
                <td>{{ ticket.title }}</td>
                <td>{{ ticket.categories }}</td>
                <td>{{ ticket.status }}</td>
                <td>{{ ticket.created_by }}</td>
                <td>{{ ticket.assigned_to }}</td>
                <td class="text-sm">{{ ticket.updated_at }}</td>
            </tr>
        </tbody>
    </table>
</template>