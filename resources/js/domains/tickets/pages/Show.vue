<script setup lang="ts">
import { getTicketComments } from '@/domains/comments/store';
import { getTicketNotes } from '@/domains/notes/store';
import { Note, type Comment } from '@/helpers/types';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Comments from '../components/Comments.vue';
import Notes from '../components/Notes.vue';
import Summary from '../components/Summary.vue';
import { getTicket, loadTickets, ticketsInitialized } from '../store';
import { adminsInitialized, getAdmins } from '@/domains/users/store.js';

const route = useRoute();
const router = useRouter();

const ticketId = Number(route.params.id);

const ticket = getTicket(ticketId);
const comments = ref<Comment[]>([]);
const notes = ref<Note[]>([]);

onMounted(async () => {
    !adminsInitialized.value ? await getAdmins() : null;
    !ticketsInitialized.value ? await loadTickets() : null;
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