<template>
    <input
        type="text"
        v-model="newTask.name"
        @keyup.enter="addTodo"
        autofocus="autofocus"
        placeholder="What need to be done?"
        class="new-todo"
    />
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
const baseUrl = "http://127.0.0.1:8000/";
import { useStore } from "vuex";

const store = useStore();
const newTask = ref({
    name: "",
    completed: false
});

const addTodo = async () => {
    // console.log(newTask.value.name);
    try {
        const res = await axios.post(baseUrl + "api/tasks", {
            name: newTask.value.name,
            completed: newTask.value.completed,
        });
        if (res.data.status === true) {
            store.dispatch("GET_TODOS");
        }
    } catch (error) {}
};
</script>

