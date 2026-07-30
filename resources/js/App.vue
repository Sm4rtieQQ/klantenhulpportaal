<script setup lang="ts">
import axios from 'axios';

const logout = async () => {
    try {
        await axios.post('/api/logout');
        console.log('Succesvol uitgelogd')
    } catch (error: any) {
        if (error.response) {
            console.error(`Er ging iets mis: (${error.response.status})`, error.response.data);
        }
    }
}
</script>

<template>
    <nav class="flex px-20 gap-4">
        <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
        <router-link :to="{ name: 'auth.login' }" class="ml-auto">Inloggen</router-link>
        <button @click="logout">Uitloggen</button>
    </nav>

    <div class="px-20 bg-amber-50 min-h-screen">
        <router-view />
    </div>
</template>

<style scoped>
button {
    all: unset;
    cursor: pointer;
}
</style>