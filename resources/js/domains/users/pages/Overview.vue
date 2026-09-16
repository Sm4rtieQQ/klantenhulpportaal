<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { deleteUser, getUsersSortedBy, usersInitialized } from '../store';
import { initializer } from '@/helpers/initializer';
import { getRouter } from '@/router/instance';
import { User } from '@/helpers/types';
import ErrorMessage from '@/services/error/ErrorMessage.vue';

const { initializeUsers } = initializer();
const router = getRouter();

const users = getUsersSortedBy('surname');

const targetUser = ref<Partial<User> | null>(null);
const togglePopup = (id?: number) => {

    if (id) {
        targetUser.value = users.value.find(user => user.id === id) ?? null;
    }
    else {
        targetUser.value = null;
    }
}

onMounted(() => {
    initializeUsers();
})

const handleDelete = async (id: number) => {
    await deleteUser(id);
    targetUser.value = null;
}
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
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!usersInitialized">
                <td colspan="6">Gebruikers worden geladen...</td>
            </tr>
            <tr v-else-if="users.length === 0">
                <td colspan="6">Geen gebruikers gevonden.</td>
            </tr>
            <template v-else v-for="user in users" :key="user.id">
                <tr class="cursor-pointer group" @click="router.push({
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
                    <td class="group-hover:bg-black/8">
                        <button @click.stop="togglePopup(user.id)"
                            class="px-1 font-bold text-xs text-red-900">X</button>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>

    <div v-if="targetUser" class="fixed top-0 left-0 w-full h-full bg-black/40">
        <div
            class="fixed grid bg-slate-300 p-4 text-center gap-y-2 shadow-lg w-100 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <h2 class="text-red-900 font-bold">
                U staat op het punt om {{ targetUser.name }} {{ targetUser.surname }} te verwijderen!
            </h2>
            <h3>Weet u het zeker? Deze actie kan niet ongedaan gemaakt worden!</h3>
            <ErrorMessage />

            <button @click="handleDelete(Number(targetUser.id))">Verwijder</button>
            <button @click="togglePopup()">Annuleren</button>
        </div>
    </div>

</template>