<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { addComment } from '../store';

const props = defineProps<{ ticketId: number }>();
const emit = defineEmits<{ saved: [] }>();

const newComment = ref({ body: '' });

const handleSubmit = async (data: any) => {
    await addComment(data);
    emit('saved');
}

</script>

<template>
    <label>Plaats reactie:</label>
    <Form :comment="newComment" :ticketId="props.ticketId" @submit="handleSubmit" />
</template>