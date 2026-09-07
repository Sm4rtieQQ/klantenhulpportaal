<script setup lang="ts">
import { ref } from 'vue';
import { addComment } from '../store';
import { Comment } from '@/helpers/types';

const newComment = ref<{ Partial<Comment>}>();

const handleSubmit = async () => {
    await addComment(newComment.value);
}
</script>

<template>
    <form class="grid">
        <label>Plaats reactie:</label>
        <textarea id:comment name:comment v-model="newComment"></textarea>
        <button type="submit">>></button>
    </form>
</template>