<script setup lang="ts">
import { formatDate } from '@/helpers/formatters';
import type { Comment } from '@/helpers/types';

const props = withDefaults(defineProps<{ comments?: Comment[] }>(), {
    comments: () => [],
});

</script>

<template>
    <div v-for="comment in props.comments" :key="comment.id" class="my-4 p-4 bg-amber-100">
        <h4>{{ comment.created_by }}</h4>
        <p>{{ comment.body }}</p>
        <h6>{{ formatDate(comment.created_at) }}</h6>
    </div>
</template>