<template>
    <div class="create-task-container">
        <h2>Update Task</h2>
        <div class="form-group">
            <label>{{ $t('title') }}</label>
            <input
                type="text"
                placeholder="Task Title"
                v-model="task.title"
            /><br>

            <label>{{ $t('description') }}</label>
            <input
                type="text"
                placeholder="Task Description"
                v-model="task.description"
            />

            <button @click="updateTask">Update</button>
        </div>

        <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import axios from "../axiosInstance";

export default {
    data() {
        return {
            task: {
                id: this.$route.params.id,
                title: "",
                description: ""
            },
            errorMessage: "",
        };
    },

    async mounted() {
        await this.fetchTask();
    },

    methods: {
        ...mapActions(['updateTask', 'fetchTasks']),
        async fetchTask() {
            try {
                const response = await axios.get(`/show/${this.task.id}`);

                if (response.status === 200) {
                    this.task = response.data; // Assume your backend sends the task object directly
                } else {
                    console.error("Task not found:", response);
                    this.errorMessage = "Task not found.";
                }
            } catch (error) {
                console.error('Error fetching task:', error.response ? error.response.data : error);
                if (error.response && error.response.status === 404) {
                    this.errorMessage = "Task not found or endpoint incorrect.";
                } else {
                    this.errorMessage = "Error fetching task. Please try again.";
                }
            }
        },

        async updateTask() {
            try {
                await this.updateTask(this.task);
                this.$router.push({name: "ListOfTasks"});
            } catch (error) {
                console.error("Error updating task:", error.response ? error.response.data : error);
                this.errorMessage = "Error updating task. Please try again.";
            }
        }
    }
};
</script>

<style scoped>
.create-task-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h2 {
    text-align: center;
    color: #3498db;
    margin-bottom: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-size: 14px;
    color: #333;
}

input {
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
}

button {
    padding: 12px;
    font-size: 16px;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2980b9;
}

.error-message {
    color: red;
    margin-top: 10px;
}
</style>

