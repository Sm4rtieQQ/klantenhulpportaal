<script setup lang="ts">
import { onMounted } from 'vue';
import { getUsersSortedBy, usersInitialized } from '../store';
import { initializer } from '@/helpers/initializer';
import { getRouter } from '@/router/instance';

const router = getRouter();

const { initializeUsers } = initializer();

const users = getUsersSortedBy('surname');

onMounted(() => {
    initializeUsers();
})

</script>


<template>
    <h1>Gebruikers:</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Achternaam</th>
                <th>Voornaam</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th>Telefoonnummer</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!usersInitialized">
                <td colspan="6">Gebruikers worden geladen...</td>
            </tr>
            <tr v-else-if="users.length === 0">
                <td colspan="6">Geen gebruikers gevonden.</td>
            </tr>
            <tr v-else v-for="user in users" :key="user.id" class="cursor-pointer group" @click="router.push({
                name: 'users.edit',
                params: { id: user.id },
            })">
                <td class="group-hover:bg-black/8" v-if="user.admin">⋆</td>
                <td class="group-hover:bg-black/8" v-else></td>
                <td class="group-hover:bg-black/8">{{ user.surname }}</td>
                <td class="group-hover:bg-black/8">{{ user.name }}</td>
                <td class="group-hover:bg-black/8">{{ user.email }}</td>
                <td class="group-hover:bg-black/8">{{ user.role }}</td>
                <td class="group-hover:bg-black/8">{{ user.tel }}</td>
            </tr>
        </tbody>
    </table>
</template>