<script setup lang="ts">
import { useRoute } from 'vue-router';
import { getTicket } from '../store';
const route = useRoute();
const ticketId = Number(route.params.id);
const ticket = getTicket(ticketId);

</script>

<template>
    <div name="ticket-details" class="p-4">
        <h1>{{ ticket.title }}</h1>
        <p class="my-4">{{ ticket.body }}</p>

        <h6>Aangemaakt op: <span>{{ ticket.created_at }}</span></h6>
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
    </div>

    <div name="ticket-comments" class="p-4">
        <h2>Opmerkingen</h2>
        <div v-for="comment in comments" :key="comment.id" class="my-4 p-4 border rounded">
            <p>{{ comment.body }}</p>
            <h6>{{ comment.created_at }}</h6>
            <h6>Door: <span>{{ comment.created_by }}</span></h6>
        </div>
    </div>

</template>