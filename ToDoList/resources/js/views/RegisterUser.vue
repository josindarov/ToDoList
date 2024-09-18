<template>
    <div class="register">
        <h2>Register</h2>
        <form @submit.prevent="register">
            <div>
                <label for="name">{{ $t('name') }}</label>
                <input type="text" v-model="form.name" required>
            </div>
            <div>
                <label for="email">{{ $t('email') }}</label>
                <input type="email" v-model="form.email" required>
            </div>
            <div>
                <label for="password">{{ $t('password') }}</label>
                <input type="password" v-model="form.password" required>
            </div>
            <div>
                <label for="password_confirmation">{{ $t('confirmPassword') }}</label>
                <input type="password" v-model="form.password_confirmation" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import {mapActions, mapState, mapMutations} from "vuex";
import '../../scss/AuthForm.scss'
import '../../scss/RegisterUser.scss'

export default {
    computed: {
        ...mapState('auth', ['form']),

        name: {
            get() {
                return this.form.name;
            },
            set(value) {
                return this.setFormField({field: 'name', value});
            }
        },
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
        },
        password_confirmation: {
            get() {
                return this.form.password_confirmation;
            },
            set(value) {
                return this.setFormField({field: 'password_confirmation', value});
            }
        },
    },
    methods: {
        ...mapMutations('auth', ['setFormField']),

        ...mapActions('auth', ['registration']),

        async register() {
            await this.registration().then(() => {
                this.$router.push({name: 'LoginUser'})
            })
        },
    }
};
</script>

