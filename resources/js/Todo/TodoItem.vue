<template>
    <li class="todo" :class="{ completed: todo.completed == true }">
        <div class="view" @dblclick="startEditing((todo = todo))">
            <span @click="toggleCheck((todo = todo))">
                <input
                    type="checkbox"
                    v-model="todo.completed"
                    class="toggle"
                    :disabled="todo.completed == true"
                    :checked="todo.completed == true"
            /></span>

            <a v-if="editing && !todo.completed">
                <input
                    v-model="editedName"
                    @keyup.enter="saveEdit((todo = todo))"
                    @blur="cancelEdit"
                    class="edit"
                    style="height: 30px; width: 90%"
                />
            </a>
            <a v-else>
                <label>{{ todo.name }}</label>

                <button @click="removeTodo((id = todo.id))" class="destroy">
                    x
                </button>
            </a>
        </div>
    </li>
    <hr />
</template>

<script setup>
import todoStore from "../store/todo.js";
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
const { props } = defineProps(["todo"]);
import { inject } from "vue";
const baseUrl = inject("baseUrl");
const editing = ref(false);
const editedName = ref("");
let type = 1;

const removeTodo = async (id) => {
    // console.log(baseUrl.value + "api/tasks/" + id);
    try {
        const result = await Swal.fire({
            title: "Delete Task",
            text: "Are you sure you want to delete this task?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1f2937",
            cancelButtonColor: "#99a9c0",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        });

        if (result.isConfirmed) {
            try {
                const res = await axios.delete(
                    baseUrl.value + "api/tasks/" + id
                );
                if (res.data.status === true) {
                    Swal.fire({
                        icon: "success",
                        title: "Successful Delete Task-Data",
                        showConfirmButton: true,
                        timer: 1500,
                    });
                    todoStore.dispatch("getTodos", type);
                }
            } catch (error) {}
        }
    } catch (error) {}
};

const toggleCheck = async (todo) => {
    // console.log(todo.completed);
    todo.completed = !todo.completed;
    try {
        const result = await Swal.fire({
            title: "Complete Task",
            text: "Are you sure you want to complete this task?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1f2937",
            cancelButtonColor: "#99a9c0",
            confirmButtonText: "Yes, complete it!",
            cancelButtonText: "Cancel",
        });

        if (result.isConfirmed) {
            try {
                const res = await axios.put(
                    baseUrl.value + "api/tasks/" + todo.id,
                    {
                        completed: todo.completed,
                        name: todo.name,
                    }
                );
                if (res.data.status === true) {
                    Swal.fire({
                        icon: "success",
                        title: "Successful Completed Task",
                        showConfirmButton: true,
                        timer: 1500,
                    });
                }
                todoStore.dispatch("getTodos", type);
            } catch (error) {}
        }
        todoStore.dispatch("getTodos", type);
    } catch (error) {}

};

const startEditing = (todo) => {
    editing.value = true;
    editedName.value = todo.name;
};

const saveEdit = async (todo) => {
    try {
        const res = await axios.put(baseUrl.value + "api/tasks/" + todo.id, {
            completed: todo.completed,
            name: editedName.value,
        });

        if (res.data.status === true) {
            Swal.fire({
                icon: "success",
                title: "Successful Edit Task-Data",
                showConfirmButton: true,
            });
            todoStore.dispatch("getTodos", type);
        }
    } catch (error) {}

    editing.value = false;
};

const cancelEdit = () => {
    editing.value = false;
};
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
@import "../../css/todo.css";
</style>
