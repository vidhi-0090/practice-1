<template>
    <li class="todo" :class="{ completed: todo.completed }">
        <div class="view">
            <span @click="toggleCheck((todo = todo))">
                <input
                    type="checkbox"
                    v-model="todo.completed"
                    :checked="todo.completed"
                    class="toggle"
                />
                <label>{{ todo.name }}</label>
            </span>
            <button @click="removeTodo((id = todo.id))" class="destroy">
                x
            </button>
        </div>
    </li>
</template>

<script setup>
import { ref } from "vue";
import { useStore } from "vuex";
import axios from "axios";
const { props } = defineProps(["todo"]);
const store = useStore();
const baseUrl = "http://127.0.0.1:8000/";

const removeTodo = async (id) => {
    console.log(baseUrl + "api/tasks/" + id);
    try {
        const res = await axios.delete(baseUrl + "api/tasks/" + id);
        if (res.data.status === true) {
            store.dispatch("GET_TODOS");
        }
    } catch (error) {}
};

const toggleCheck = async (todo) => {
    console.log(todo.completed);
    todo.completed = !todo.completed;
    try {
        const res = await axios.put(baseUrl + "api/tasks/" + todo.id, {
            completed: todo.completed,
        });
        if (res.data.status === true) {
            store.dispatch("GET_TODOS");
        }
    } catch (error) {}
};
</script>

<style lang="scss" scoped>
@import "../../css/app.css";

h1 {
    text-align: center;
    color: #ebd7d8;
    font-size: 85px;
}
ul.todo-list{
    text-align: center;
    margin-left: 500px;
}
.view {
    width:300px;
    text-align: left;
}
button.destroy {
    float: right !important;
}
input.toggle {
    border-radius: 50%;
    margin-right: 5px;
}

li.todo.completed {
    text-decoration: line-through;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    display: flex;
    justify-content: space-between;
}
</style>
