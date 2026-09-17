<script setup lang="ts">
import { User } from '@/helpers/types';
import FormError from '@/services/error/FormError.vue';
import { ref } from 'vue';

const props = defineProps<{ user: User }>();
const emit = defineEmits(['submit']);

const user = ref({ ...props.user });

const handleSubmit = () => {
    emit('submit', user.value);
};
</script>

<template>
    <form @submit.prevent="handleSubmit" class="grid">
        <label for="name">Voornaam</label>
        <FormError name="name" />
        <input id="name" v-model="user.name" type="text" />

        <label for="surname">Achternaam</label>
        <FormError name="surname" />
        <input id="surname" v-model="user.surname" type="text" />

        <label for="email">E-mailadres</label>
        <FormError name="email" />
        <input id="email" v-model="user.email" type="email" />

        <label for="role">Rol</label>
        <FormError name="role" />
        <input id="role" v-model="user.role" type="text" />

        <label for="tel">Telefoonnummer</label>
        <FormError name="tel" />
        <input id="tel" v-model="user.tel" type="text" />

        <div class="grid grid-cols-[120px_20px]">
            <label for="isAdmin">Administrator</label>
            <input id="isAdmin" name="admin" v-model="user.admin" type="radio" :value="1" />

            <label for="noAdmin">Gebruiker</label>
            <input id="noAdmin" name="admin" v-model="user.admin" type="radio" :value="0" />
        </div>
        <FormError name="admin" />

        <button type="submit">Opslaan</button>
    </form>
</template>