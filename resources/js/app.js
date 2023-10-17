
//js/app.js
import "./bootstrap";

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./components/App.vue";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
// import store from "./store";
import router from "./router";
import jQuery from 'jquery';
import Todo from './Todo/TodoItem.vue';
import NewTodo from './Todo/InitialTodo.vue';
import TodoList from './Todo/TodoList.vue';
import TodoApp from './components/TodoApp.vue';
import { ref, provide, inject } from 'vue';

const baseUrl = ref("http://127.0.0.1:8000/");
library.add(fas);
window.$ = jQuery;
const app = createApp(App);

app.provide('baseUrl', baseUrl);
app.component('font-awesome-icon', FontAwesomeIcon);
app.component('todo', Todo);
app.component('new-todo', NewTodo);
app.component('todo-list', TodoList);
app.component('todo-app', TodoApp);
// app.use(store);
app.use(router);
app.mount("#app");
