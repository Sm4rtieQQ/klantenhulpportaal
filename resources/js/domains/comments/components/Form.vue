<script setup lang="ts">
import { ref } from 'vue';
import { Comment } from '@/helpers/types';

const props = defineProps<{
    comment: Partial<Comment>
    ticketId: number
}>()

const form = ref({
    ...props.comment,
    ticket_id: props.ticketId
});

const emit = defineEmits(['submit']);

const handleSubmit = () => {
    emit('submit', form.value);
    form.value.body = ''
}

</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <textarea id:comment name:comment v-model="form.body"></textarea>
        <button type="submit">>></button>
    </form>
</template>