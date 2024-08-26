<template>
    <div class="login">
        <h2>Login</h2>
        <form @submit.prevent="login">
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="form.email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" v-model="form.password" required>
            </div>
            <button type="submit">Login</button>
            <div v-if="errors.length">
                <ul>
                    <li v-for="error in errors" :key="error">{{ error }}</li>
                </ul>
            </div>
        </form>
        <button @click="register">Register</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            errors: []
        };
    },
    methods: {
        async login() {
            try {
                const response = await axios.post('/api/login', this.form);
                localStorage.setItem('token', response.data.token);
                this.$router.push('/tasks');
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    this.errors = Object.values(error.response.data.errors).flat();
                } else {
                    console.error('An unexpected error occurred:', error);
                }
                alert('You are not registered. Please register');
                await this.register();
            }
        },

        async register(){
            this.$router.push('/register');
        }
    }
};
</script>

<style scoped>

.login {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-weight: bold;
    color: #555;
}

input {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

button {
    padding: 12px 20px;
    font-size: 16px;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
    width: 100%;
}

button:hover {
    background-color: #2980b9;
}

.error-messages {
    margin-top: 10px;
    color: #e74c3c;
}

ul {
    padding-left: 20px;
}

</style>
