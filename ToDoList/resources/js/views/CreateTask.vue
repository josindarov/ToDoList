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
