import { createApp } from 'vue'
import { createStore } from 'vuex';

import App from './components/App';
import router from './Router';

//import data from './store/data';

const app = createApp({});

const store = createStore({
    modules: {
        //data
    }
})

app.component('app', App)
    .use(router)
    .use(store)
    .mount('#app');

require('./bootstrap');
