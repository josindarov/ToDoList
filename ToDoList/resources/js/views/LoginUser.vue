<template>
    <div class="login">
        <h2>Login</h2>
        <form @submit.prevent="loginUser">
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="form.email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" v-model="form.password" required>
            </div>
            <button type="submit" >
                Login
            </button>
        </form>
        <button @click="navigateToRegister">Register</button>
    </div>
</template>

<script>
import {mapActions, mapState} from 'vuex';
export default {
    computed: {
        ...mapState({
            form: state => state.form
        }),
        email: {
            get() {
                return this.form.email;
            },
            set(value) {
                this.$store.commit('setForm', { ...this.form, email: value });
            }
        },
        password: {
            get() {
                return this.form.password;
            },
            set(value) {
                this.$store.commit('setForm', { ...this.form, password: value });
            }
        }
    },

    methods: {
        ...mapActions(['login']),

        async loginUser(){
            try {
                this.login().then(() => this.$router.push('/tasks'))
            }catch (error){
                alert("User is not registered")
            }

        },

        navigateToRegister() {
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

button:disabled {
    background-color: #bdc3c7;
    cursor: not-allowed;
}

.error-messages {
    margin-top: 10px;
    color: #e74c3c;
}

ul {
    padding-left: 20px;
}
</style>
