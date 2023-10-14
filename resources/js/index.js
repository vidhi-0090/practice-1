// js/index.js
import { createStore } from "vuex";
import axios from "axios";
const store = createStore({
    state: {
        //variables define
        isAuthenticated: 0,
        todos: [],

    },

    mutations: {
        //state updtae
        UPDATE_AUTHENTICATION(state, payload) {
            state.isAuthenticated = payload;
        },

        GET_TODOS(state, todos) {
            state.todos = todos;
        },

    },

    actions: {
        //action to be perform
        setAuthenticated(context, payload) {
            localStorage.setItem("token", payload);
            context.commit("UPDATE_AUTHENTICATION", payload);
        },
        removeAuthenticated(context) {
            localStorage.removeItem("token");
            context.commit("UPDATE_AUTHENTICATION", 0);
        },

        GET_TODOS({ commit }) {
            axios
                .get("/api/tasks")
                .then((res) => {
                    {
                        console.log(res.data);
                        commit("GET_TODOS", res.data);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },

    },

    getters: {
        //get variable valaue
        getIsAuthenticated: function (state) {
            return state.isAuthenticated;
        },

        getTodos: (state) => {
            return state.todos;
        },


    },
});

export default store;
