<script setup lang="ts">
import { formatDate } from '@/helpers/formatters';

const props = defineProps({ ticket: Object });
const ticket = { ...props.ticket };

</script>


<template>
    <h1>{{ ticket.title }}</h1>
    <p class="my-4">{{ ticket.body }}</p>
    <span v-for="category in ticket.categories" class="mr-2 border border-gray-300 p-1 text-xs">{{ category.name
        }}</span>

    <table class="max-w-200 mt-4">
        <tbody>
            <tr>
                <th>Status:</th>
                <td>{{ ticket.status_description }}</td>

            </tr>
            <tr>
                <th>Aangemaakt door:</th>
                <td>{{ ticket.created_by }}</td>
            </tr>
            <tr>
                <th>Toegewezen aan:</th>
                <td>{{ ticket.assigned_to }}</td>
            </tr>
            <tr>
                <th>Aangemaakt op:</th>
                <td>{{ formatDate(ticket.created_at) }}</td>
            </tr>
            <tr>
                <th>Laatste update:</th>
                <td>{{ formatDate(ticket.updated_at) }}</td>
            </tr>
        </tbody>
    </table>
</template>
