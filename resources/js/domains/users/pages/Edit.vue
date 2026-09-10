<script setup lang="ts">
import { initializer } from '@/helpers/initializer';
import { useRoute } from 'vue-router';
import { getUser, usersInitialized } from '../store';
import { onMounted } from 'vue';
import Form from '../components/Form.vue';
import { getRouter } from '@/router/instance';

const route = useRoute();
const router = getRouter();

const { initializeUsers } = initializer();

const userId = Number(route.params.id);

const user = getUser(userId);

onMounted(async () => {
    await initializeUsers();
})

const handleSubmit = async (data: any) => {
    router.push({ name: 'users.overview' });
}

</script>

<template>
    <div v-if="usersInitialized && user">
        <h1>{{ user.name }} {{ user.surname }}</h1>
        <Form :user="user" @submit="handleSubmit" />
    </div>
</template>