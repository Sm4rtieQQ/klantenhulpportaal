<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { getTicket, loadTickets, ticketsInitialized } from '../store';
import { getTicketComments } from '@/domains/comments/store';
import { Note, type Comment } from '@/helpers/types';
import Summary from '../components/Summary.vue';
import Comments from '../components/Comments.vue';
import { getTicketNotes } from '@/domains/notes/store';
import Notes from '../components/Notes.vue';
import ErrorMessage from '@/services/error/ErrorMessage.vue';

const route = useRoute();
const router = useRouter();

const ticketId = Number(route.params.id);

const ticket = getTicket(ticketId);
const comments = ref<Comment[]>([]);
const notes = ref<Note[]>([]);

onMounted(async () => {
    if (!ticketsInitialized.value) {
        await loadTickets();
    }
    comments.value = await getTicketComments(ticketId);
    notes.value = await getTicketNotes(ticketId);
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


            <h3 class="mt-8">Opmerkingen</h3>
            <Comments :comments="comments" />
        </div>

        <div>
            <h3>Notities</h3>
            <Notes :notes="notes" />
        </div>
    </div>
</template>