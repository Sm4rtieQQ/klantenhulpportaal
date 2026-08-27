<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps({ ticket: Object });
const emit = defineEmits(['submit']);

const form = ref({ ...props.ticket })


const handleSubmit = () => emit('submit', form.value)

</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <label for="title">Titel</label>
        <input id="title" v-model="form.title" type="text" />

        <label for="body">Omschrijving</label>
        <textarea id="body" v-model="form.body" type="text" class="min-h-50"></textarea>

        <h5>Aangemaakt door: {{ form.created_by.name }} {{ form.created_by.surname }}</h5>

        <button type="submit">Opslaan</button>
    </form>

</template>