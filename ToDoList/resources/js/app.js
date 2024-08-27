import { createApp } from 'vue';
import App from './views/app.vue';
import router from './router';
import i18n from "./i18n";
import store from './store';

createApp(App)
    .use(router)
    .use(i18n)
    .use(store)
    .mount('#app');
