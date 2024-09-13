<template>
    <div :class="{'blur-background': showForm}">
        <div class="controls">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search by title"
            />
        </div>

        <el-table :data="filteredTasks" style="width: 100%">
            <el-table-column prop="id" label="ID" width="50" />
            <el-table-column prop="title" label="Title" />
            <el-table-column prop="description" label="Description" />
            <el-table-column prop="deadline" label="Deadline" width="180" />
            <el-table-column prop="completed" label="Status" width="180">
                <template #default="scope">
                    <span
                        v-if="scope.row.completed === 1"
                        class="status done"
                    >Done
                    </span>

                    <span
                        v-else
                        class="status in-progress"
                    >In Progress
                    </span>
                </template>
            </el-table-column>

            <el-table-column label="Actions" width="200">
                <template #default="scope">
                    <el-button
                        class="editButton"
                        size="small"
                        @click="updateForm(scope.row)"
                    >Edit</el-button>
                    <el-button
                        class="deleteButton"
                        @click="deleteTask(scope.row.id)"
                    >Delete</el-button>
                </template>
            </el-table-column>
        </el-table>

        <div>
            <button @click="createForm">
                create task
            </button>
        </div>
    </div>

    <TaskForm
        v-if="showForm"
        @closeForm="closeForm"
        :isUpdate="isUpdate"
        :taskData="currentTask"
    >
    </TaskForm>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import TaskForm from "../components/Task/TaskForm.vue";
import '../../scss/DataTable.scss'


export default {
    data() {
        return {
            showForm: false,
            isUpdate: false,
            currentTask: null,
            searchQuery: "",
        };
    },

    components: {
        TaskForm
    },

    computed: {
        ...mapGetters({
            tasks: 'task/getTasks'
        }),

        filteredTasks() {
            if (this.searchQuery) {
                return this.tasks.filter(task =>
                    task.title.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }
            return this.tasks;
        },
    },

    methods: {
        ...mapActions({
            fetchTasks: "task/fetchTasks",
            deleteTaskAction: "task/deleteTask",
        }),

        createForm() {
            this.isUpdate = false;
            this.currentTask = undefined;
            this.showForm = true;
        },

        updateForm(task){
            this.isUpdate = true;
            this.currentTask = task;
            this.showForm = true;
        },

        closeForm() {
            this.showForm = false;
            this.currentTask = null;
            this.fetchTasks();
        },

        async fetchData() {
            await this.fetchTasks();
        },

        deleteTask(id) {
            this.deleteTaskAction(id).then(() => (alert("Task is deleted")));
        }
    },

    created() {
        this.fetchData();
    }
};
</script>
