// js/index.js
import { createStore } from "vuex";
import axios from "axios";
const store = createStore({
    state: {
        //variables define
        isAuthenticated: 0,
    },

    mutations: {
        //state updtae
        updateAuthentication(state, payload) {
            state.isAuthenticated = payload;
        }
    },

    actions: {
        //action to be perform
        setAuthenticated(context, payload) {
            localStorage.setItem("token", payload);
            context.commit("updateAuthentication", payload);
        },
        removeAuthenticated(context) {
            localStorage.removeItem("token");
            context.commit("updateAuthentication", 0);
        },
    },

    getters: {
        //get variable valaue
        getIsAuthenticated: function (state) {
            return state.isAuthenticated;
        }
    },
});

export default store;
