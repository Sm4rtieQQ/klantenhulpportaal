<template>
    <div v-if="getMessage" class="text-red-500 text-sm">
        {{ getMessage }}
    </div>
</template>

<script setup lang="ts">
import { getMessage } from '.';
</script>