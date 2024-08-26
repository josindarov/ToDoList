import { createApp } from 'vue';
import App from './views/app.vue';
import router from './router';

createApp(App)
    .use(router)
    .mount('#app');
