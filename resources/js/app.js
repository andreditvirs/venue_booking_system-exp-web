require('./bootstrap');
   
import { createApp } from 'vue';
import vuex from 'vuex';
import router from './routes';
import store from './store';

const app = createApp({});

app.use(store);
app.use(router);
app.use(vuex);
app.mount('#app');

