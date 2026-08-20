<template>
    <div class="bg-amber-50 min-h-screen">
        <nav class="flex px-20 gap-4">
            <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
            <router-link :to="{ name: 'auth.login' }">Inloggen</router-link>
        </nav>

        <div class="px-20 grid">
            <router-view />
        </div>
    </div>
</template>

<style scoped>
button {
    all: unset;
    cursor: pointer;
}
</style>