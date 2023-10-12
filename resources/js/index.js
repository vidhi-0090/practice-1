
// js/index.js
import { createStore } from "vuex";

const store = createStore({
  state: {
    isAuthenticated: false, // Initialize as false
  },
  mutations: {
    // Mutation to set the authentication status
    setAuthenticationStatus(state, isAuthenticated) {
      state.isAuthenticated = isAuthenticated;
    },
  },
});

export default store;
