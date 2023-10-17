// js/index.js
import { createStore } from "vuex";
import axios from "axios";
const store = createStore({
    state: {
        //variables define
        notes: [],
    },

    mutations: {
        //state updtae

        getNotes(state, notes) {
            state.notes = notes;
        },
    },

    actions: {
        //action to be perform
        getNotes({ commit }) {
            const notesData =
                JSON.parse(localStorage.getItem("notesData")) || [];

            if (notesData) {
                commit("getNotes", notesData);
            }
        },

        removeNotes({ commit },id) {
            axios
                .delete("/api/notes/" +id +"?allDelete="+id);
        },
    },

    getters: {
        //get variable valaue

        getNotes: (state) => {
            return state.notes;
        },
    },
});

export default store;
