import axiosInstance from "../axiosInstance";

export default {
    namespaced: true,
    state:{
        tasks: []
    },

    mutations: {
        setTasks(state, payload) {
            state.tasks = payload;
        },
        addTask(state, payload) {
            state.tasks.push(payload);
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
            const response = await axiosInstance.get('/task/index');
            commit('setTasks', response.data);
        },
        async createTask({ commit}, task) {
            const response = await axiosInstance.post('/task/store', task);
            commit('addTask', response.data);
        },
        async updateTask({ commit }, {id, task}) {
            try {
                const response = await axiosInstance.put(`/task/update/${id}`, task);
                commit('updateTask', response.data);
            } catch (error) {
                console.error("Error updating task:", error);
                throw error;
            }
        },
        async deleteTask({ commit }, taskId) {
            await axiosInstance.delete(`/task/delete/${taskId}`);
            commit('deleteTask', taskId);
        },
        async startTask({commit}, taskId){
            await axiosInstance.post(`/task/status/start/${taskId}`);
        },
        async completeTask({commit}, taskId){
            await axiosInstance.post(`/task/status/complete/${taskId}`);
        },
    },
    getters: {
        getTasks(state) {
            return state.tasks;
        }
    }
}
