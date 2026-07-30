<script setup lang="ts">
import { getMessage } from '.';
</script>

<template>
    <div v-if="getMessage">
        {{ getMessage }}
    </div>
</template>