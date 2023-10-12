
//js/app.js
import "./bootstrap";

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import store from "./index.js";
import router from "./router";
import jQuery from 'jquery';

window.$ = jQuery;
library.add(fas);
const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
app.use(store);
app.use(router);
app.mount("#app");
