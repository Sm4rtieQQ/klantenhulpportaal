<script setup lang="ts">
import { User } from '@/helpers/types';
import { ref } from 'vue';

const props = defineProps<{ user: User }>();
const emit = defineEmits(['submit']);

const user = ref({ ...props.user });

const handleSubmit = () => emit('submit', user.value);
</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <label for="name">Voornaam</label>
        <input id="name" v-model="user.name" type="text" />

        <label for="surname">Achternaam</label>
        <input id="surname" v-model="user.surname" type="text" />

        <label for="email">E-mailadres</label>
        <input id="email" v-model="user.email" type="email" />

        <label for="role">Rol</label>
        <input id="role" v-model="user.role" type="text" />

        <label for="tel">Telefoonnummer</label>
        <input id="tel" v-model="user.tel" type="text" />

        <div class="grid grid-cols-[120px_20px]">
            <label for="isAdmin">Administrator</label>
            <input id="isAdmin" name="admin" v-model="user.admin" type="radio" :value="1" />

            <label for="noAdmin">Gebruiker</label>
            <input id="noAdmin" name="admin" v-model="user.admin" type="radio" :value="0" />
        </div>

        <button type="submit">Opslaan</button>
    </form>
</template>