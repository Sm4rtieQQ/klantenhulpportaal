<script setup lang="ts">
import { onMounted } from 'vue';
import { useAuth } from './domains/auth/store';
import Login from './domains/auth/components/Login.vue';

const { user, authInitialized, isAdmin, initializeAuth, login, logout } = useAuth();

onMounted(async () => {
    await initializeAuth();
});

</script>

<template>
    <div class="bg-slate-50 min-h-screen">
        <nav v-if="user" class="flex px-10 gap-4 bg-slate-300 py-4 fixed top-0 w-screen shadow-md items-center">
            <span class="font-serif font-bold text-3xl mr-6">Klantenhulpportaal</span>
            <router-link :to="{ name: 'tickets.overview' }"
                class="font-bold text-lg px-3 py-1 hover:bg-black/8 active:bg-black/12 rounded">Overzicht</router-link>
            <router-link :to="{ name: 'tickets.create' }"
                class="font-bold text-lg px-3 py-1 hover:bg-black/8 active:bg-black/12 rounded">Nieuw
                ticket</router-link>
            <router-link :to="{ name: 'categories.overview' }"
                class="font-bold text-lg px-3 py-1 hover:bg-black/8 active:bg-black/12 rounded"
                v-if="isAdmin()">Categoriën</router-link>
            <router-link :to="{ name: 'users.overview' }"
                class="font-bold text-lg px-3 py-1 hover:bg-black/8 active:bg-black/12 rounded"
                v-if="isAdmin()">Gebruikers</router-link>
            <div class="ml-auto">
                <h4>{{ user.name }} {{ user.surname }}</h4>
                <h5 v-if="isAdmin()">Administrator</h5>
                <h5 v-else>Gebruiker</h5>
            </div>
            <a @click="logout"
                class="cursor-pointer text-sm font-semibold px-3 py-1 hover:bg-black/8 active:bg-black/12 rounded">Uitloggen</a>
        </nav>

        <div class="px-20 pt-22 pb-10 grid">
            <h2 v-if="!authInitialized">Authentification in progress...</h2>

            <login v-else-if="!user" @submit="login" />

            <router-view v-else />
        </div>
    </div>

</template>
