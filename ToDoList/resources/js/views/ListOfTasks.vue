<template>
    <div>
        <h1>Task List</h1>
        <div v-if="loading">Loading tasks...</div>
        <div v-else>
            <table v-if="tasks.length > 0">
                <tr>
                    <th>{{ $t('title') }}</th>
                    <th>{{ $t('description') }}</th>
                    <th>{{ $t('action') }}</th>
                </tr>
                <tr v-for="task in tasks" :key="task.id">
                    <td>{{ task.title }}</td>
                    <td>{{ task.description }}</td>
                    <td>
                        <span @click="updateTask(task)" class="icon update-icon">&#x270E;</span>
                        <span @click="deleteTask(task.id)" class="icon delete-icon">&#x1F5D1;</span>
                    </td>
                </tr>
            </table>
            <div v-else>No tasks available.</div>
        </div>
        <button @click="createNewTask">Create a New Task</button>
    </div>
</template>

<script>
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed, onMounted, ref } from 'vue';

export default {
    setup() {
        const store = useStore();
        const router = useRouter();

        const tasks = computed(() => store.getters.getTasks);

        onMounted(async () => {
            await store.dispatch('fetchTasks');
            loading.value = false;
        });

        // Methods
        const updateTask = (task) => {
            router.push({ name: 'UpdateTask', params: { id: task.id } });
        };

        const deleteTask = async (taskId) => {
            await store.dispatch('deleteTask', taskId);
        };

        const createNewTask = () => {
            router.push({ name: 'CreateTask' });
        };

        return {
            tasks,
            updateTask,
            deleteTask,
            createNewTask
        };
    },
};
</script>

<style scoped>
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h1 {
    color: #444;
}

table {
    width: 100%;
    max-width: 800px;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 15px;
    text-align: left;
}

th {
    background-color: #3498db;
    color: #fff;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f1f1;
}

button {
    padding: 12px 24px;
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

.icon {
    cursor: pointer;
    font-size: 18px;
    margin: 0 5px;
}

.update-icon {
    color: #2ecc71; /* Green color for update icon */
}

.delete-icon {
    color: #e74c3c; /* Red color for delete icon */
}

.icon:hover {
    opacity: 0.7;
}

button {
    padding: 12px 24px;
    font-size: 16px;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px; /* Add space above the button */
}

button:hover {
    background-color: #2980b9;
}

table.center {
    margin-left:auto;
    margin-right:auto;
}
</style>
