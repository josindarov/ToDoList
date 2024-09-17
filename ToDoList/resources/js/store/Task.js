import axiosInstance from "../axiosInstance";

export default {
    namespaced: true,
    state:{
        tasks: [],
        task: null,
        form: {
            id: null,
            title: '',
            description: '',
            deadline: '',
            category_id: null,
            category: '',
            status: null
        }
    },

    mutations: {
        setTasks(state, payload) {
            state.tasks = payload;
        },

        addTask(state, payload) {
            state.tasks.push(payload);
        },

        setFormField(state, {field, value}) {
            state.form[field] = value;
        },

        setTask(state, payload) {
            state.task = payload;
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
        async fetchTasks({ commit }) {
            const response = await axiosInstance.get('/index');
            commit('setTasks', response.data);
        },
        async fetchTask({ commit }, taskId) {
            const response = await axiosInstance.get(`/show/${taskId}`);
            commit('setTask', response.data);
        },
        async createTask({ commit}, task) {
            const response = await axiosInstance.post('/store', task);
            commit('addTask', response.data);
        },

        async updateTask({ commit }, {id, task}) {
            try {
                const response = await axiosInstance.put(`/update/${id}`, task);
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
        getTasks(state) {
            return state.tasks;
        },

        getTask(state){
            return state.task;
        }

    }
}
