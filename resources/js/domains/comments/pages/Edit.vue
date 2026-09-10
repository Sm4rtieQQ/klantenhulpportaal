<script setup lang="ts">
import { ref } from 'vue';
import Form from '../components/Form.vue';
import { updateComment } from '../store';
import { formatDate } from '@/helpers/formatters.js';

const props = defineProps<{
    comment: any
    ticketId: number
}>();

const emit = defineEmits<{
    saved: []
    cancelled: []
}>();

const existingComment = ref({ ...props.comment });

const handleSubmit = async (data: any) => {
    await updateComment(existingComment.value.id, data);
    emit('saved');
}

</script>

<template>
    <h4>{{ comment.created_by }}</h4>
    <h6>Reactie wijzigen</h6>
    <Form :comment="existingComment" :ticketId="props.ticketId" @submit="handleSubmit" />
    <h6>{{ formatDate(comment.created_at) }}</h6>
</template>