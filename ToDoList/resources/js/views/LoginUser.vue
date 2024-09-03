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
import '../../scss/AuthForm.scss'
import '../../scss/LoginUser.scss'
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

