<script setup lang="ts">
import { ref } from 'vue';
import { Note } from '@/helpers/types';
import FormError from '@/services/error/FormError.vue';

const props = defineProps<{
    note: Partial<Note>
    ticketId: number
}>()

const form = ref({
    ...props.note,
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
        <FormError name="body" />
        <textarea id:note name:note v-model="form.body"></textarea>
        <button type="submit">>></button>
    </form>
</template>