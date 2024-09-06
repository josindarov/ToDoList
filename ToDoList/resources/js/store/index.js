import { createStore } from 'vuex';
import axiosInstance from "../axiosInstance";

export default createStore({
    state: {
        user: null,
        tasks: [],
        form: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        },
        task: {
            id: null,
            title: '',
            description: '',
            deadline: '',
            completed: null
        }
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
        },

        setForm(state, form) {
            state.form = form;
        },

        setTask(state, task) {
            state.task = task;
        }
    },
    actions: {
        async register({ commit, state }) {
            const user = {
                name: state.form.name,
                email: state.form.email,
                password: state.form.password,
                password_confirmation: state.form.password_confirmation
            }
            const response = await axiosInstance.post('/register', user);
            commit('setUser', response.data);
        },

        async login({ commit, state }) {
            try {
                const user = {
                    email: state.form.email,
                    password: state.form.password
                }
                const response = await axiosInstance.post('/login', user);
                const token = response.data.token;
                if (token) {
                    localStorage.setItem('token', token);
                    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    commit('setUser', response.data.user);
                }
            } catch (error) {
                console.error("Login error:", error);
            }
        },

        async fetchTasks({ commit }) {
            const response = await axiosInstance.get('/index');
            commit('setTasks', response.data);
        },
        async fetchTask({ commit }, payload) {
            try {
                const response = await axiosInstance.get(`/show/${payload.id}`);
                commit('setTask', response.data);
            } catch (error) {
                console.error("Error fetching task:", error);
                throw error;  // Rethrow to handle in component
            }
        },
        async createTask({ commit, state }) {
            const task = {
                title: state.task.title,
                description: state.task.description,
                deadline: state.task.deadline,
            }

            const response = await axiosInstance.post('/store', task);
            commit('addTask', response.data);
        },
        async updateTask({ commit, state }) {
            const task = {
                id: state.task.id,
                title: state.task.title,
                description: state.task.description,
                deadline: state.task.deadline,
                completed: state.task.completed,
            };

            try {
                const response = await axiosInstance.put(`/update/${task.id}`, task);
                commit('updateTask', response.data);
            } catch (error) {
                console.error("Error updating task:", error);
                throw error;
            }
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
