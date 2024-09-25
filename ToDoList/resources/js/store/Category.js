import axiosInstance from "../axiosInstance";


export default {
    namespaced: true,
    state: {
        name: {type: String, default: null},
        categories: []
    },
    mutations: {
        setCategoryValue(state, { field, value }) {
            state[field] = value;
        }
    },
    actions: {
        async fetchCategories({commit}){
            await axiosInstance.get('/category/index')
                .then(response => {
                    const categories = response.data;
                    commit('setCategoryValue', {field: 'categories', value: categories});
                }).catch((error) => {throw error})
        },
        async create({commit},data){
            return axiosInstance.post('/category/store', data).catch((error) => {throw error});
        }
    },

    getters: {
        getCategories(state){
            return state.categories;
        }
    }
}
