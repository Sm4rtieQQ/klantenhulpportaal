<script setup lang="ts">
import axios from 'axios';
import Login from '../components/Login.vue';

const login = async (data: any) => {
    console.log(data);
    try {
        await axios.get('/sanctum/csrf-cookie');
        await axios.post('/api/login', data);
        console.log('Succesvol ingelogd!');
    } catch {
        console.error('er ging iets mis');
    }
}

const whoAmI = async () => {
    try {
        const response = await axios.get('/api/user');
        console.log(response.data);
    } catch {
        console.log('niet ingelogd');
    }

}
</script>

<template>
    <Login @submit="login" />
    <button @click="whoAmI">Who am I?</button>

</template>