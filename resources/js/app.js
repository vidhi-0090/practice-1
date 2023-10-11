import "./bootstrap";

import { createApp } from "vue";
// import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';

import router from "./router";
import jQuery from 'jquery';
// import DataTable from 'laravel-vue-datatable';

window.$ = jQuery;
library.add(fas);
const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
// app.use(DataTable);
// app.component('baseUrl', 'http://127.0.0.1:8000/');

// const routes = [
//     { path: '/ref', component: Ref },
//     { path: '/reactive', component: Reactive },
//     { path: '/computed', component: ComputedProperties },
//     { path: '/', component: ComputedProperties },
// ];

// const router = createRouter({
//     history: createWebHistory(),
//     routes,
// });

//install plubin without option
// app.use(FirstPlugin)

//install plugin with opion

app.use(router);
app.mount("#app");
