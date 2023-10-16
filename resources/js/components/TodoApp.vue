<template>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                Welcome Todo Home Page
            </h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <section class="todoapp">
                <header class="header">
                    <h1>todos</h1>
                </header>

                <div class="form_container">
                    <div class="title_container">
                        <InitialTodo></InitialTodo>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>

<script setup>
import InitialTodo from "../Todo/InitialTodo.vue";
</script>

<style lang="scss" scoped>
@import "../../css/app.css";
.form_container {
    text-align: center;
}

h1 {
    text-align: center;
    color: #99a9c0;
    font-size: 85px;
}
.view {
    width: 100%;
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

ul.todo-list {
    text-align: center;
    margin-left: 343px;
    line-height: 32px;
    font-size: 18px;
    color: #28292a;
}
li.todo {
    width: 60%;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    display: flex;
    justify-content: space-between;
}

.new-todo {
    width: 45%;
    height: 50px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

[type="text"]:focus {
    border-color: #5f5e5e;
    --tw-ring-color: #696868;
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
        calc(1px + var(--tw-ring-offset-width)) #6c6969;
}

[type="checkbox"][data-v-4a4e98e1] {
    color: #488b48;
}

[type="checkbox"][data-v-4a4e98e1]:focus {
    --tw-ring-color: #237f23;
}
</style>
