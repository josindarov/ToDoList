<template>
    <div class="create-task-container">
        <h2>Update Task</h2>
        <div class="form-group">
            <label>{{ $t('messages.title') }}</label>
            <input
                type="text"
                placeholder="Task Title"
                v-model="task.title"
            /><br>

            <label>{{ $t('messages.description') }}</label>
            <input
                type="text"
                placeholder="Task Description"
                v-model="task.description"
            />

            <button @click="updateTask">Update</button>
        </div>
    </div>
</template>


<script>
import axios from "../axiosInstance";

export default {
    data() {
        return {
            task: {
                id: this.$route.params.id,
                title: "",
                description: ""
            }
        };
    },

    async mounted() {
        try {
            const response = await axios.get(`/show/${this.task.id}`);
            this.task = response.data;
        } catch (error) {
            console.error('Error fetching task:', error);
        }
    },

    methods: {
        async updateTask() {
            try {
                const response = await axios.put(`/update/${this.task.id}`,{
                    title: this.task.title,
                    description: this.task.description,
                });

                if (response.status === 200) { // Check for success status code
                    // Reset form inputs
                    this.task.title = "";
                    this.task.description = "";

                    // Redirect to the Task List
                    this.$router.push({ name: "ListOfTasks" });
                } else {
                    console.error("Failed to update task:", response);
                }
            } catch (error) {
                console.error("Error updating task:", error.response ? error.response.data : error);
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
</style>
