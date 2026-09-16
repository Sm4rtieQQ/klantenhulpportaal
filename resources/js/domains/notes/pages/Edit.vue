<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { updateNote } from '../store';
import { formatDate } from '@/helpers/formatters.js';

const props = defineProps<{
    note: any
    ticketId: number
}>();

const emit = defineEmits<{
    saved: []
    cancelled: []
}>();

const existingNote = ref({ ...props.note });

const handleSubmit = async (data: any) => {
    await updateNote(existingNote.value.id, data);
    emit('saved');
}

</script>

<template>
    <h4>{{ note.created_by }}</h4>
    <h6>Reactie wijzigen</h6>
    <Form :note="existingNote" :ticketId="props.ticketId" @submit="handleSubmit" />
    <h6>{{ formatDate(note.created_at) }}</h6>
</template>