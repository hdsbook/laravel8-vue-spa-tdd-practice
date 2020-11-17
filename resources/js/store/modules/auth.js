import { redirect } from "../../router";

// state
export const state = {
  user: null
};

// getters
export const getters = {
  check: state => state.user !== null,
};

// mutations
export const mutations = {
  setUser: (state, payload) => state.user = payload
};

// actions
export const actions = {
  async fetchUser({ commit }) {
    try {
      const { data } = await axios.get(base_url('api/user'));
      commit('setUser', data);
    } catch (e) {
      commit('setUser', null);
    }
  },

  logOut({ commit }) {
    return axios.post('logout').then(() => {
      commit('setUser', null);
      location.reload();
    }).catch(() => {
      console.log('logout error');
    });
  }
};
