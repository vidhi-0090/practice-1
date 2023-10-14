//../resources/js/components/TodoApp.vue

<template>
    <section class="todoapp">
        <header class="header">
            <h1>todos</h1>
        </header>

        <div class="form_container">
            <div class="title_container">
                <new-todo></new-todo>
                <todo-list></todo-list>
            </div>
        </div>
    </section>
</template>

<script setup>
import NewTodo from "../Todo/NewTodo.vue";
import TodoList from "../Todo/TodoList.vue";
import { mapGetters } from "vuex";
import { onMounted } from "vue";
import { useStore } from "vuex";
import axios from "axios";
const store = useStore();
</script>

<style scoped>
h1 {
    text-align: center;
    color: #ebd7d8;
    font-size: 85px;
}

.form_container {
    text-align: center;
}
</style>
