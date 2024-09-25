<template>
    <div :class="{'blur-background': showForm}">
        <div class="controls">
            <input
                v-model="searchQuery"
                type="text"
                placeholder="Search by title"
            />
        </div>

        <div class="table">
            <el-table :data="paginatedTasks" style="width: 100%">
                <el-table-column prop="id" label="ID" width="50" />
                <el-table-column prop="title" label="Title" />
                <el-table-column prop="description" label="Description" />
                <el-table-column prop="deadline" label="Deadline" width="180" />
                <el-table-column prop="status" label="Status" width="180">
                    <template #default="scope">
                        <el-select
                            v-model="scope.row.status"
                            @change="handleStatusChange(scope.row)"
                            placeholder="Select"
                            style="width: 100%"
                        >
                            <el-option label="Not Started" value="Not Started" />
                            <el-option label="In Progress" value="In Progress" />
                            <el-option label="Completed" value="Completed" />
                        </el-select>
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
        </div>

        <div class="pagination-container">
            <el-pagination
                @current-change="handlePageChange"
                :current-page="currentPage"
                :page-size="pageSize"
                :total="filteredTasks.length"
                background layout="prev, pager, next"
            />
        </div>

        <div class="actions-container">
            <button class="create-btn" @click="createForm">
                {{ $t('createTask') }}
            </button>

            <div >
                <FileUpload @fileUploaded="fetchTasks" />
            </div>

            <div>
                <DownloadFile />
            </div>
        </div>
    </div>

    <TaskForm
        v-if="showForm"
        @closeForm="closeForm"
        :isUpdate="isUpdate"
        :taskData="currentTask"
        :categories="categories"
    />
</template>

<script>
import {mapActions, mapGetters, mapState} from "vuex";
import TaskForm from "../components/Task/TaskForm.vue";
import FileUpload from "../components/FileUpload.vue";
import DownloadFile from "../components/DownloadFile.vue";
import '../../scss/DataTable.scss'

export default {
    data() {
        return {
            showForm: false,
            isUpdate: false,
            currentTask: null,
            searchQuery: "",
            currentPage: 1,
            pageSize: 5
        };
    },

    components: {
        TaskForm,
        FileUpload,
        DownloadFile
    },

    computed: {
        ...mapGetters({
            tasks: 'task/getTasks',
        }),

        ...mapState('category', {categories: "categories"}),

        filteredTasks() {
            if (this.searchQuery) {
                return this.tasks.filter(task =>
                    task.title.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            }

            return this.tasks;
        },

        paginatedTasks() {
            const start = (this.currentPage - 1) * this.pageSize;
            const end = start + this.pageSize;
            return this.filteredTasks.slice(start, end);
        },
    },

    methods: {
        ...mapActions({
            fetchTasks: "task/fetchTasks",
            deleteTaskAction: "task/deleteTask",
            fetchCategories: "category/fetchCategories",
            startTask: "task/startTask",
            completeTask: "task/completeTask",
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
            await this.fetchCategories();
        },

        async deleteTask(id) {
            await this.deleteTaskAction(id).then(() => (alert("Task is deleted")));
        },

        handlePageChange(page) {
            this.currentPage = page;
        },

        async handleStatusChange(task) {
            try {
                console.log(task.status);
                if (task.status === "In Progress") {
                    await this.startTask(task.id);
                } else if (task.status === "Completed") {
                    await this.completeTask(task.id);
                } else {
                    alert("Invalid status transition");
                }
                await this.fetchTasks();
            } catch (error) {
                alert("An error occurred while changing status");
            }
        }
    },

    created() {
        this.fetchData();
    }
};
</script>

