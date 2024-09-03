<template>
    <div class="update-task-container">
        <h2>Update Task</h2>
        <div class="form-group">
            <label>{{ $t('title') }}</label>
            <input
                type="text"
                placeholder="Task Title"
                v-model="title"
            /><br>

            <label>{{ $t('description') }}</label>
            <input
                type="text"
                placeholder="Task Description"
                v-model="description"
            /><br>

            <label>{{ $t('deadline') }}</label>
            <input
                type="datetime-local"
                placeholder="Task Deadline"
                v-model="deadline"
            /><br>
            <label for="task">Choose a task status</label>
            <select id="task" v-model="completed">
                <option value="0">In Progress</option>
                <option value="1">Done</option>
            </select>

            <button @click="updateTodo">Update</button>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import '../../scss/TaskForm.scss'
import '../../scss/UpdateTask.scss'

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
        },
        completed: {
            get() {
                return this.task.completed;
            },
            set(value) {
                this.$store.commit('setTask', { ...this.task, completed: value });
            }
        },
    },
    methods: {
        ...mapActions(['updateTask', 'fetchTask']),
        async updateTodo() {
            await this.updateTask().then(() => {
                this.$router.push('/tasks');
            }).catch(error => {
                console.error("Error updating task:", error);
            });
        }
    },
    async created() {
        await this.fetchTask({ id: this.$route.params.id }).catch(error => {
            console.error("Error fetching task:", error);
        });
    }
};
</script>
