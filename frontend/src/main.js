import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

store.dispatch("auth/attempt", localStorage.getItem("access_token"));

const app = createApp(App);
app.use(router);
app.use(store);
app.mount("#app");