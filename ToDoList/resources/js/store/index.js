import { createStore } from 'vuex';
import auth from './Auth.js'
import task from './Task.js';
import category from './Category.js';

const store = createStore({
    modules: {
        auth,
        task,
        category
    }
});

export default store;
