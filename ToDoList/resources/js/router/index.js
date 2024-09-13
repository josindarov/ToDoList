import { createRouter, createWebHistory } from 'vue-router';
import RegisterUser from '../views/RegisterUser.vue';
import LoginUser from '../views/LoginUser.vue';
import DataTable from "../views/DataTable.vue";


const routes = [
    {path: '/', name: 'LoginUser', component: LoginUser },
    {path: '/register', name: 'RegisterUser', component: RegisterUser },
    { path: '/tasks', name: 'ListOfTasks', component: DataTable }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
