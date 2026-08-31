<template>
    <div v-if="getErrorByProperty(name)" class="text-red-500 text-sm">
        {{ getErrorByProperty(name) }}
    </div>
</template>

<script setup lang="ts">
import { getErrorByProperty } from '.';

defineProps<{ name: string }>();

</script>