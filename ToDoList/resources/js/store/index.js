import { createStore } from 'vuex';
import axios from 'axios';
import axiosInstance from "../axiosInstance";

export default createStore({
    state: {
        user: null,
        tasks: [],
    },
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        setTasks(state, tasks) {
            state.tasks = tasks;
        },
        addTask(state, task) {
            state.tasks.push(task);
        },
        updateTask(state, updatedTask) {
            const index = state.tasks.findIndex(task => task.id === updatedTask.id);
            if (index !== -1) {
                state.tasks.splice(index, 1, updatedTask);
            }
        },
        deleteTask(state, taskId) {
            state.tasks = state.tasks.filter(task => task.id !== taskId);
        }
    },
    actions: {
        async register({ commit }, user) {
            const response = await axiosInstance.post('/api/register', user);
            commit('setUser', response.data);
        },
        async login({ commit }, user) {
            try {
                const response = await axiosInstance.post('/login', user);
                const token = response.data.token;
                if (token) {
                    localStorage.setItem('token', token);
                    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                }
                commit('setUser', response.data.user);
            } catch (error) {
                console.error("Login error:", error);
            }
        },
        async fetchTasks({ commit }) {
            const response = await axiosInstance.get('/index');
            commit('setTasks', response.data);
        },
        async createTask({ commit }, task) {
            const response = await axiosInstance.post('/store', task);
            commit('addTask', response.data);
        },
        async updateTask({ commit }, task) {
            const response = await axiosInstance.put(`/update/${task.id}`, task);
            commit('updateTask', response.data);
        },
        async deleteTask({ commit }, taskId) {
            await axiosInstance.delete(`/delete/${taskId}`);
            commit('deleteTask', taskId);
        }
    },

    getters: {
        getUser(state) {
            return state.user;
        },
        getTasks(state) {
            return state.tasks;
        }
    }
});
