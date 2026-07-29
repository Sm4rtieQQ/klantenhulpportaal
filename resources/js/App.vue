<template>
    <nav class="flex px-20">
        <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
        <router-link :to="{ name: 'auth.login' }" class="ml-auto">Inloggen</router-link>
    </nav>

    <div class="px-20 bg-amber-50 min-h-screen">
        <router-view />
    </div>
</template>