
// js/index.js
import { createStore } from "vuex";

const store = createStore({

  state: {
    //variables define
    isAuthenticated: 0,
  },

  mutations: {
    //state updtae
    UPDATE_AUTHENTICATION(state, payload){
        state.isAuthenticated = payload
    }
  },

  actions: {
    //action to be perform
    setAuthenticated(context, payload) {
        localStorage.setItem("token",payload);
        context.commit('UPDATE_AUTHENTICATION',payload);
    },
    removeAuthenticated(context) {
        localStorage.removeItem("token");
        context.commit('UPDATE_AUTHENTICATION',0);
    }
  },

  getters: {
    //get variable valaue
    getIsAuthenticated: function(state){
        return state.isAuthenticated;
    }
  }

});

export default store;
