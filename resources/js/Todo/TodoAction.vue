<template>
    <div class="filter">
        <hr />
        <a style="float: left; margin-left: 25px; padding: 6px 10px; font-size: 16px;"
            ><b> {{ todoStore.getters.getCountTodo }} </b> Item Left </a
        >
        <a
            class="filter-button"
            :class="{ active: activeFilter === 3 }"
            @click="filter((type = 3))"
        >
            Completed
        </a>
        <a
            class="filter-button"
            :class="{ active: activeFilter === 2 }"
            @click="filter((type = 2))"
        >
            Active
        </a>
        <a
            class="filter-button"
            :class="{ active: activeFilter === 1 }"
            @click="filter((type = 1))"
        >
            All
        </a>
    </div>
</template>

<script setup>
import { ref} from "vue";
import todoStore from "../store/todo.js";

const activeFilter = ref(1);
const filter = async (type) => {
    try {
        activeFilter.value = type;
        // console.log(type);
        todoStore.dispatch("getTodos", type);
    } catch (error) {}
};
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
@import "../../css/todo.css";
</style>
