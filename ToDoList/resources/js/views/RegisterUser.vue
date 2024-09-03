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
import '../../scss/AuthForm.scss'
import '../../scss/RegisterUser.scss'

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

