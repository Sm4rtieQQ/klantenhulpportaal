<template>
    <nav class="flex px-20 gap-4">
        <router-link :to="{ name: 'tickets.overview' }">Ticket overzicht</router-link>
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