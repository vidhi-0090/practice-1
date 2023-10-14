<template>
    <ul class="todo-list">
        <todo v-for="todo in todos" :todo="todo" :key="todo.id" />
    </ul>
</template>

<script setup>
import { mapGetters } from "vuex";
import Todo from "../Todo/Todo.vue";
import { useStore } from "vuex";
import { onMounted, computed } from "vue";
import axios from "axios";
const store = useStore();

onMounted(() => {
    store.dispatch("GET_TODOS");
});

const todos = computed(() => {
    return store.getters.getTodos;
});
</script>

<style scoped>
ul.todo-list{
    text-align: center;
    margin-left: 500px;
}
li.todo {
    width: 30%;
}
</style>
