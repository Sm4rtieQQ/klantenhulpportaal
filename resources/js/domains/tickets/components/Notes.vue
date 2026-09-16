<script setup lang="ts">
import { deleteNote } from '@/domains/notes/store';
import { formatDate } from '@/helpers/formatters';
import type { Note } from '@/helpers/types';
import { ref } from 'vue';
import Edit from '@/domains/notes/pages/Edit.vue';

const props = withDefaults(defineProps<{ notes?: Note[]; ticketId: number }>(), {
    notes: () => [],
});

const emit = defineEmits<{ saved: [] }>();

const currentEdit = ref<number | null>();

const toggleEdit = (id: number) => {
    currentEdit.value = id
};

const update = () => {
    emit('saved');
    currentEdit.value = null;
}

const destroy = async (id: number) => {
    await deleteNote(id);
    emit('saved');
}
</script>

<template>
    <div v-if="props.notes.length !== 0" v-for="note in props.notes" :key="note.id" class="my-4 p-2 bg-slate-200">
        <div v-if="currentEdit === note.id">
            <Edit :note="note" :ticket-id="props.ticketId" @saved="update" />
        </div>
        <div v-else>
            <h4>{{ note.created_by }}</h4>
            <p class="text-sm">{{ note.body }}</p>
            <h6>{{ formatDate(note.created_at) }}</h6>
            <div class="flex gap-3">
                <a @click="toggleEdit(note.id)" class="actionLink">Bewerken</a>
                <a @click="destroy(note.id)" class="actionLink destroy">Verwijderen</a>
            </div>
        </div>
    </div>
    <div v-else class="italic">Geen notities gevonden</div>
</template>