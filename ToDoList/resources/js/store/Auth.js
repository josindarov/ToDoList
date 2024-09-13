import axiosInstance from "../axiosInstance";

export default {
    namespaced:true,
    state: {
        isAuthenticated: false,
        user: null,
        token: null,
        form: {
            name: null,
            email: null,
            password: null,
            password_confirmation: null
        }
    },
    mutations: {
        setAuthenticated(state, payload) {
            state.isAuthenticated = payload;
        },
        setUser(state, payload){
            state.user = payload
        },
        setToken(state, payload){
            state.token = payload
        },
        setFormField(state, {field, value}) {
            state.form[field] = value;
        }

    },
    actions: {
        async login({commit, state}){
            try {
                const user = state.form
                const response = await axiosInstance.post('/login', user);
                const token = response.data.token;
                if (token) {
                    localStorage.setItem('token', token);
                    axiosInstance.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    commit('setAuthenticated', true);
                    commit('setToken', response.data.token);
                    commit('setUser', response.data.user);
                }
            } catch (error) {
                console.error("Login error:", error);
            }
        },

        async logout({commit}){
            return axiosInstance.post('/logout')
                .then(() => {
                    commit("setAuthenticated", false);
                    commit("setUser", null);
                    commit("setToken", null);

                    localStorage.removeItem('authToken');
                    delete axios.defaults.headers.common['Authorization'];
                })
                .catch(error => {
                    console.log(error);
                    throw error;
                })
        },

        async registration({commit, state}){
            const userData = state.form;
            console.log(userData);
            return axiosInstance.post('/register', userData)
                .then(response => {
                    const token = response.data.token
                    const user = response.data.user

                    commit("setToken", token);
                    commit("setAuthenticated", true);
                    commit("setUser", user);

                    localStorage.setItem('authToken', token);

                    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                })
                .catch(error => {
                    console.log(error);
                    throw error;
                })
        }
    },

    getters: {
        user: state => state.user,
        token: state => state.token
    }
}
