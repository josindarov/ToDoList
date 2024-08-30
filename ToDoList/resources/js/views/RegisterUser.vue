<template>
    <div class="register">
        <h2>Register</h2>
        <form @submit.prevent="registerUser">
            <div>
                <label for="name">Name:</label>
                <input type="text" v-model="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" v-model="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" v-model="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" v-model="password_confirmation" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    computed: {
        ...mapState({
            form: state => state.form
        }),
        name: {
            get() {
                return this.form.name;
            },
            set(value) {
                this.$store.commit('setForm', { ...this.form, name: value });
            }
        },
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
        },
        password_confirmation: {
            get() {
                return this.form.password_confirmation;
            },
            set(value) {
                this.$store.commit('setForm', { ...this.form, password_confirmation: value });
            }
        },
    },
    methods: {
        ...mapActions(['register']),

        registerUser() {
            this.register().then(this.navigateToLogin());
        },
        navigateToLogin(){
            this.$router.push('/');
        }
    }
};
</script>

<style scoped>
.register {
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
