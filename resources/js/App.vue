<script setup lang="ts">
import { onMounted, watch } from 'vue';
import { useAuth } from './domains/auth/store';
import Login from './domains/auth/components/Login.vue';

const { user, authInitialized, initializeAuth, login, logout } = useAuth();

onMounted(initializeAuth);

watch(
    [user, authInitialized],
    async ([currentUser, initialized]) => {
        if (currentUser && initialized) {
        }
    }
);

</script>

<template>
    <div class="bg-amber-50 min-h-screen">
        <nav v-if="user" class="flex px-20 gap-4 h-16">
            <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
            <div class="ml-auto">
                <h4>{{ user.name }} {{ user.surname }}</h4>
                <a @click="logout" class="cursor-pointer text-sm">Uitloggen</a>
            </div>
        </nav>

        <div class="px-20 grid">
            <h2 v-if="!authInitialized">Authentification in progress...</h2>

            <login v-else-if="!user" @submit="login" />

            <router-view v-else />
        </div>
    </div>
</template>
