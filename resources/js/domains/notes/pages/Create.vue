<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { addNote } from '../store';

const props = defineProps<{ ticketId: number }>();
const emit = defineEmits<{ saved: [] }>();

const newNote = ref({ body: '' });

const handleSubmit = async (data: any) => {
    await addNote(data);
    emit('saved');
}

</script>

<template>
    <label>Plaats reactie:</label>
    <Form :note="newNote" :ticketId="props.ticketId" @submit="handleSubmit" />
</template>