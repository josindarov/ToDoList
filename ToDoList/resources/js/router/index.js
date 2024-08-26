import { createRouter, createWebHistory } from 'vue-router';
import ListOfTasks from '../views/ListOfTasks.vue';
import CreateTask from '../views/CreateTask.vue';
import UpdateTask from "../views/UpdateTask.vue";
import RegisterUser from '../views/RegisterUser.vue';
import LoginUser from '../views/LoginUser.vue';


const routes = [
    { path: '/tasks', name: 'ListOfTasks', component: ListOfTasks },
    { path: '/create', name: 'CreateTask', component: CreateTask },
    {path: '/update/:id', name: 'UpdateTask', component: UpdateTask },
    {path: '/register', name: 'RegisterUser', component: RegisterUser },
    {path: '/login', name: 'LoginUser', component: LoginUser },
    {path: '/', name: 'LoginUser', component: LoginUser },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
