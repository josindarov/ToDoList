<template>
    <div class="create-task-container">
        <h2>{{ $t('createTask') }}</h2>
        <div class="form-group">
            <label>{{ $t('title') }}</label>
            <input
                type="text"
                v-model="title"
            /><br>

            <label>{{ $t('description') }}</label>
            <input
                type="text"
                v-model="description"
            />

            <label>{{ $t('deadline') }}</label>
            <input
                type="datetime-local"
                v-model="deadline"
            /><br>
            <button @click="createTodo">Create</button>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";
import '../../scss/TaskForm.scss'
import '../../scss/CreateTask.scss'

export default {
    computed: {
        ...mapState({
            task: state => state.task
        }),
        title: {
            get() {
                return this.task.title;
            },
            set(value) {
                this.$store.commit('setTask', { ...this.task, title: value });
            }
        },
        description: {
            get() {
                return this.task.description;
            },
            set(value) {
                this.$store.commit('setTask', { ...this.task, description: value });
            }
        },
        deadline: {
            get() {
                return this.task.deadline;
            },
            set(value) {
                this.$store.commit('setTask', { ...this.task, deadline: value });
            }
        }
    },

    methods: {
        ...mapActions(['createTask']),

        async createTodo() {
            await this.createTask().then(() => this.$router.push('/tasks'));
        }
    }
};
</script>

