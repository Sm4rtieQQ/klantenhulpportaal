<script setup lang="ts">
import { useRoute } from 'vue-router';
import { getTicket } from '../store';

const route = useRoute();
const ticketId = Number(route.params.id);
const ticket = getTicket(ticketId);
</script>

<template>
    <h1>{{ ticket.title }}</h1>
    <p class="my-4">{{ ticket.body }}</p>

    <h6>Laatste update: <span>{{ ticket.updated_at }}</span></h6>

    <table class="max-w-80 mt-4">
        <tbody>
            <tr>
                <th>Status:</th>
                <td>{{ ticket.status }}</td>
            </tr>
            <tr>
                <th>Aangemaakt door:</th>
                <td>{{ ticket.created_by }}</td>
            </tr>
            <tr>
                <th>Toegewezen aan:</th>
                <td>{{ ticket.assigned_to }}</td>
            </tr>
        </tbody>
    </table>

</template>