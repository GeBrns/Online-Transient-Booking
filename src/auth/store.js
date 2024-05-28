// store.js
import { createStore } from 'vuex';

const store = createStore({
  state: {
    authToken: localStorage.getItem('authToken') || null,
    startDate: '',
    endDate: '',
  },
  getters: {
    isAuthenticated: state => !!state.authToken,
  },
  mutations: {
    setAuthToken(state, token) {
      state.authToken = token;
      localStorage.setItem('authToken', token);
    },
    clearAuthToken(state) {
      state.authToken = null;
      localStorage.removeItem('authToken');
    },
    setReservationData(state, payload) {
      state.startDate = payload.startDate;
      state.endDate = payload.endDate;
    },
  },
  actions: {
    login({ commit }, token) {
      commit('setAuthToken', token);
    },
    logout({ commit }) {
      commit('clearAuthToken');
    },
    updateReservationData({ commit }, payload) {
      commit('setReservationData', payload);
    },
  },
});

export default store;
