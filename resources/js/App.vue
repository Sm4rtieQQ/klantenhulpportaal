<template>
    <nav class="flex">
        <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
        <router-link :to="{ name: 'auth.login' }" class="ml-auto">Inloggen</router-link>
    </nav>

    <router-view />
</template>