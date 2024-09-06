<template>
    <v-container>
        <v-row>
            <v-col>
                <!-- Search Bar -->
                <v-text-field
                    v-model="search"
                    label="Search"
                    prepend-inner-icon="mdi-magnify"
                    class="mb-4"
                ></v-text-field>

                <!-- Data Table -->
                <v-data-table
                    :headers="headers"
                    :items="tasks"
                    :search="search"
                    item-value="id"
                    class="elevation-1"
                >
                    <!-- Slot for status column -->
                    <template v-slot:item.status="{ item }">
                        <span v-if="item.completed">Done</span>
                        <span v-else>In Progress</span>
                    </template>
                    <!-- Slot for actions column -->
                    <template v-slot:item.actions="{ item }">
                        <v-btn
                            color="primary"
                            @click="updateTask(item)"
                            class="mr-2"
                        >
                            Edit
                        </v-btn>
                        <v-btn
                            color="error"
                            @click="deleteTask(item.id)"
                        >
                            Delete
                        </v-btn>
                    </template>
                </v-data-table>

                <!-- File Upload Form for Import -->
                <v-form @submit.prevent="importTasksFromFile">
                    <v-file-input
                        v-model="excelFile"
                        label="Upload Excel File"
                        accept=".xlsx"
                        prepend-icon="mdi-file-excel"
                        outlined
                        dense
                        required
                    ></v-file-input>
                    <v-btn
                        type="submit"
                        color="success"
                        class="mt-4"
                    >
                        Import Tasks
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
        <v-btn @click="createNewTask" class="mt-4">
            Create a New Task
        </v-btn>
    </v-container>
</template>

<script>
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';
import { computed, onMounted, ref } from 'vue';
import { VDataTable, VContainer, VRow, VCol, VBtn, VTextField, VFileInput, VForm } from 'vuetify/components';
import axiosInstance from "../axiosInstance";

export default {
    setup() {
        const store = useStore();
        const router = useRouter();

        const tasks = computed(() => store.getters.getTasks);
        const search = ref('');
        const excelFile = ref(null); // File input ref for the Excel file

        onMounted(async () => {
            await store.dispatch('fetchTasks');
        });

        const headers = [
            { title: 'Title', value: 'title', sortable: true },
            { title: 'Description', value: 'description' },
            { title: 'Deadline', value: 'deadline', sortable: true },
            { title: 'Status', value: 'status', sortable: true },
            { title: 'Actions', value: 'actions', sortable: false },
        ];

        // Navigation and action methods
        const updateTask = (task) => {
            router.push({ name: 'UpdateTask', params: { id: task.id } });
        };

        const deleteTask = async (taskId) => {
            await store.dispatch('deleteTask', taskId);
        };

        const createNewTask = () => {
            router.push({ name: 'CreateTask' });
        };

        // Method to import tasks from the uploaded Excel file
        const importTasksFromFile = async () => {
            if (!excelFile.value) {
                console.error("No file selected!");
                return;
            }

            try {
                const formData = new FormData();
                formData.append('file', excelFile.value);

                // Send a POST request to the API for importing tasks
                await axiosInstance.post(`/tasks/import`, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });

                await store.dispatch('fetchTasks');
                excelFile.value = null;
            } catch (error) {
                console.error("Error importing tasks:", error);
            }
        };

        return {
            tasks,
            headers,
            search,
            updateTask,
            deleteTask,
            createNewTask,
            excelFile,
            importTasksFromFile,
        };
    },
    components: {
        VDataTable,
        VContainer,
        VRow,
        VCol,
        VBtn,
        VTextField,
        VFileInput,
        VForm,
    },
};
</script>
