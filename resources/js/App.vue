<script setup lang="ts">
import { onMounted } from 'vue';
import { useAuth } from './domains/auth/store';
import Login from './domains/auth/components/Login.vue';

const { user, authInitialized, initializeAuth, login, logout } = useAuth();

onMounted(initializeAuth);

</script>

<template>
    <div class="bg-amber-50 min-h-screen">
        <nav v-if="user" class="flex px-20 gap-4 bg-amber-300 py-4">
            <router-link :to="{ name: 'tickets.overview' }" class="font-bold text-lg">Overzicht</router-link>
            <router-link :to="{ name: 'tickets.create' }" class=" font-bold text-lg">Nieuw ticket</router-link>
            <div class="ml-auto">
                <h4>{{ user.name }} {{ user.surname }}</h4>
                <h5 v-if="user.admin">Administrator</h5>
                <h5 v-else>Gebruiker</h5>
            </div>
            <a @click="logout" class="cursor-pointer text-sm font-semibold">Uitloggen</a>
        </nav>

        <div class="px-20 pt-2 grid">
            <h2 v-if="!authInitialized">Authentification in progress...</h2>

            <login v-else-if="!user" @submit="login" />

            <router-view v-else />
        </div>
    </div>
</template>
