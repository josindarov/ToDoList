import { createApp } from 'vue';
import App from './views/app.vue';
import router from './router';
import { createI18n } from 'vue-i18n'
import app from "./views/app.vue";

const i18n = createI18n({
    // something vue-i18n options here ...
})

createApp(App)
    .use(router)
    .use(i18n)
    .mount('#app');
