import { createApp } from 'vue';
import { createVfm } from 'vue-final-modal';
import App from './App.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import * as bootstrap from 'bootstrap';
import store from '@/auth/store';


const app = createApp(App);

// Create Vue Final Modal instance
const vfm = createVfm();

// Use Vue Final Modal as a plugin
app.use(vfm);

// Use the Vue router with the Vue app
app.use(router);

// Use store from store
app.use(store);

// Mount the Vue app to the DOM
app.mount('#app');

// Assign Bootstrap to the global window object
window.bootstrap = bootstrap;
