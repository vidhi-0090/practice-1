// js/index.js
import { createStore } from "vuex";
import axios from "axios";
const store = createStore({
    state: {
        //variables define
        countTodo: 0,
        todos: [],
        type: 1,
    },

    mutations: {
        //state updtae

        getTodos(state, todos) {
            state.todos = todos;
        },

        countTodos(state, todos) {
            state.countTodo = todos;
        },
    },

    actions: {
        //action to be perform

        getTodos({ commit }, type) {
            // console.log("/api/tasks?type=" + type);
            axios
                .get("/api/tasks?type=" + type)
                .then((res) => {
                    {
                        commit("getTodos", res.data.data);
                        commit("countTodos", res.data.count);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },

    getters: {
        //get variable valaue

        getTodos: (state) => {
            return state.todos;
        },

        getCountTodo: (state) => {
            return state.countTodo;
        },
    },
});

export default store;
