import { createStore } from 'vuex';
import auth from './Auth.js'
import task from './Task.js';

const store = createStore({
    modules: {
        auth,
        task
    }
});

export default store;
