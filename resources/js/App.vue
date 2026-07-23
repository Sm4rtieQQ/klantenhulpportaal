<template>
    <nav>
        <router-link :to="{ name: 'tickets.overview' }">Tickets overzicht</ router-link>
    </nav>

    <router-view />
</template>