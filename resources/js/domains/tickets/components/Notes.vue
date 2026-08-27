<script setup lang="ts">
import { formatDate } from '@/helpers/formatters';
import type { Note } from '@/helpers/types';

const props = withDefaults(defineProps<{ notes?: Note[] }>(), {
    notes: () => [],
});

</script>

<template>
    <div v-for="note in props.notes" :key="note.id" class="my-4 p-2 bg-amber-200">
        <h4>{{ note.created_by }}</h4>
        <p class="text-sm">{{ note.body }}</p>
        <h6>{{ formatDate(note.created_at) }}</h6>
    </div>
</template>