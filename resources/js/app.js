
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
import Todo from './Todo/Todo.vue';
import NewTodo from './Todo/NewTodo.vue';
import TodoList from './Todo/TodoList.vue';
import TodoApp from './Todo/TodoApp.vue';

library.add(fas);
window.$ = jQuery;
const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
app.component('todo', Todo);
app.component('new-todo', NewTodo);
app.component('todo-list', TodoList);
app.component('todo-app', TodoApp);
app.use(store);
app.use(router);
app.mount("#app");
