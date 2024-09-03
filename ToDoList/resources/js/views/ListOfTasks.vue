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
import { VDataTable, VContainer, VRow, VCol, VBtn, VTextField } from 'vuetify/components';

export default {
    data: () => {

    },
    setup() {
        const store = useStore();
        const router = useRouter();

        const tasks = computed(() => store.getters.getTasks);

        const search = ref('');

        onMounted(async () => {
            await store.dispatch('fetchTasks');
        });

        const headers = [
            { title: 'Title', value: 'title', sortable: true},
            { title: 'Description', value: 'description' },
            { title: 'Deadline', value: 'deadline', sortable: true},
            { title: 'Status', value: 'status', sortable: true},
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

        return {
            tasks,
            headers,
            search,
            updateTask,
            deleteTask,
            createNewTask,
        };
    },
    components: {
        VDataTable,
        VContainer,
        VRow,
        VCol,
        VBtn,
        VTextField,
    },
};
</script>


