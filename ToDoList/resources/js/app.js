import { createApp } from 'vue';
import App from './views/app.vue';
import router from './router';
import i18n from './i18n';
import store from './store';
import vuetify from "./vuetify";

createApp(App)
    .use(router)
    .use(i18n)
    .use(store)
    .use(vuetify)
    .mount('#app');
