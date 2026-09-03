<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { initializer } from '@/helpers/initializer.js';
import { getTicket, ticketsInitialized } from '../store';
import { getTicketComments } from '@/domains/comments/store';
import { getTicketNotes } from '@/domains/notes/store';
import { useAuth } from '@/domains/auth/store';

import Comments from '../components/Comments.vue';
import Notes from '../components/Notes.vue';
import Summary from '../components/Summary.vue';

import type { Note, Comment } from '@/helpers/types';

const route = useRoute();
const router = useRouter();
const { isAdmin } = useAuth();
const { initializeTickets } = initializer();

const ticketId = Number(route.params.id);

let ticket = getTicket(ticketId);
const comments = ref<Comment[]>([]);
const notes = ref<Note[]>([]);

onMounted(async () => {
    initializeTickets();
    comments.value = await getTicketComments(ticketId);
    if (isAdmin()) {
        notes.value = await getTicketNotes(ticketId);
    }
});

</script>

<template>
    <div class="grid grid-cols-[60%_auto] gap-4">
        <div>
            <Summary v-if="ticketsInitialized && ticket" :ticket="ticket" />
            <div name="controls" class="text-sm font-semibold gap-2">
                <a @click="router.push({ name: 'tickets.edit', params: { id: ticket.id } })"
                    class="cursor-pointer select-none">Bewerk ticket</a>
            </div>

            <div v-if="isAdmin()">
                <h3 class="mt-8">Notities</h3>
                <Notes :notes="notes" />
            </div>
        </div>

        <div>
            <h3>Opmerkingen</h3>
            <Comments :comments="comments" />
        </div>
    </div>
</template>