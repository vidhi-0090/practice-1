<template>
    <input
        type="text"
        v-model="newTask.name"
        @keyup.enter="addTodo"
        autofocus="autofocus"
        placeholder="What needs to be done?"
        class="new-todo"
    />
    <TodoList />
    <TodoAction />
</template>

<script setup>
import TodoList from "./TodoList.vue";
import TodoAction from "./TodoAction.vue";
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import todoStore from "../store/todo.js";
import { inject } from "vue";

const baseUrl = inject("baseUrl");

const newTask = ref({
    name: "",
    completed: false,
});

const addTodo = async () => {
    try {
        const res = await axios.post(baseUrl.value + "api/tasks", {
            name: newTask.value.name,
            completed: newTask.value.completed,
        });
        if (res.data.status === true) {
            Swal.fire({
                icon: "success",
                title: "Successful Added Task-Data",
                showConfirmButton: true,
            });
            newTask.value.name = "";
            todoStore.dispatch("getTodos");
        }
    } catch (error) {}
};
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
@import "../../css/todo.css";
</style>
