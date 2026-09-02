import { createApp } from "vue";
import App from "./App.vue";
import { router } from './router';
import { setRouter } from './router/instance';

const app = createApp(App);
app.use(router);
setRouter(router);
app.mount("#app");