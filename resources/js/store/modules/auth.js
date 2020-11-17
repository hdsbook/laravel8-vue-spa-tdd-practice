import { redirect } from "../../router";

// state
export const state = {
  user: null,
  token: null,
};

// getters
export const getters = {
  user: state => state.user,
  token: state => state.token,
  check: state => state.user !== null,
  userRoles: state => state.user
    ? _.join(_.map(state.user.user_roles, 'role'), '、')
    : '',
};

// mutations
export const mutations = {
  setUser: (state, payload) => state.user = payload,
  setAuth: (state, { user, token }) => {
    state.user = user ? user : null;
    state.token = token ? token : null;
    if (token) {
      window.axios.defaults.headers.common['Authorization'] = "Bearer " + token;
    }
  },
  unsetAuth: state => {
    state.user = null;
    state.token = null;
    window.axios.defaults.headers.common['Authorization'] = null;
  }
};

// actions
export const actions = {
  async fetchUser({ commit }) {
    try {
      await axios.get(base_url('api/user')).then(res => {
        commit('setAuth', res.data);
      });
    } catch (e) {
      commit('unsetAuth');
    }
  },

  async login({ commit, dispatch }, loginData) {
    await axios.post('login', loginData);
    await dispatch('fetchUser');
    redirect('home');
  },

  logout({ commit }) {
    return axios.post('logout').then(() => {
      commit('unsetAuth');
      location.reload();
    });
  }
};
