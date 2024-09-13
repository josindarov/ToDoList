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
import {mapActions, mapState, mapMutations} from 'vuex';
import '../../scss/AuthForm.scss'
import '../../scss/LoginUser.scss'
export default {
    computed: {
        ...mapState('auth', ['form']),
        ...mapState({
            isAuthenticated: state => state.auth.isAuthenticated
        }),

        email: {
            get() {
                return this.form.email;
            },
            set(value) {
                return this.setFormField({field: 'email', value});
            }
        },
        password: {
            get() {
                return this.form.password;
            },
            set(value) {
                return this.setFormField({field: 'password', value});
            }
        }
    },

    methods: {
        ...mapMutations('auth',['setFormField']),

        ...mapActions('auth', ['login']),

        async loginUser() {
            await this.login().then(() => {
                if(this.isAuthenticated){
                    this.$router.push({name: 'ListOfTasks'});
                }
                else{
                    alert("User is not registered");
                }
            })
        },

        async navigateToRegister(){
            await this.$router.push({name: 'RegisterUser'})
        }
    }
};
</script>

