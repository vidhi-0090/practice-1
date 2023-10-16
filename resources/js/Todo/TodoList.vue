<template>
    <ul class="todo-list" style="height:500px; max-height: 500px; overflow-y: auto;">
        <TodoItem v-for="todo in todos" :todo="todo" :key="todo.id" />
    </ul>
    <br />
</template>

<script setup>

import todoStore from "../store/todo.js";
import TodoItem from "./TodoItem.vue";
import { onMounted, computed } from "vue";


onMounted(() => {
    todoStore.dispatch("getTodos");
});

const todos = computed(() => {
    return todoStore.getters.getTodos;
});
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
@import "../../css/todo.css";
</style>
