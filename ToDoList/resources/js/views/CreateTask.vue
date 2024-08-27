<template>
    <div class="create-task-container">
        <h2>{{ $t('createTask') }}</h2>
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

            <button @click="createTask">Create</button>
        </div>
        <!-- Display error message if there's any -->
        <div v-if="errorMessage" class="error-message">{{ errorMessage }}</div>
    </div>
</template>

<script>
import axios from "../axiosInstance";

export default {
    data() {
        return {
            task: {
                title: "",
                description: ""
            },
            errorMessage: "", // State to hold error messages
        };
    },

    methods: {
        async createTask() {
            this.errorMessage = ""; // Reset error message before submission

            try {
                // Send the task object directly
                const response = await axios.post("/store", this.task);

                if (response.status === 200) {
                    // Reset form inputs
                    this.task.title = "";
                    this.task.description = "";

                    // Redirect to the Task List
                    this.$router.push({ name: "ListOfTasks" });
                } else {
                    console.error("Failed to create task:", response);
                }
            } catch (error) {
                console.error("Error creating task:", error.response ? error.response.data : error);
                this.errorMessage = "An error occurred while creating the task.";
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
