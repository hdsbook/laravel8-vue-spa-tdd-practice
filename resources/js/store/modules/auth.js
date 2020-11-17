import { redirect } from "../../router";
import Cookie from 'js-cookie';
import axios from '../../plugins/axios';

// state
export const state = {
  user: null,
  token: Cookie.get('token'),
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
  setAuth: (state, { user, token, remember }) => {
    state.user = user ? user : null;
    state.token = token ? token : null;
    if (token) {
      Cookie.set('token', token, {
        expires: remember ? 365 : null
      })
    }
  },
  unsetAuth: state => {
    state.user = null;
    state.token = null;
    Cookie.remove('token');
  }
};

// actions
export const actions = {
  async fetchUser({ commit }) {
    try {
      const { data } = await axios.get(base_url('api/user'));
      commit('setAuth', data);
    } catch (e) {
      commit('unsetAuth');
    }
  },

  async login({ commit }, loginData) {
    const { data } = await axios.post(base_url('login'), loginData);

    if (loginData.remember) {
      data.remember = loginData.remember;
    }
    commit('setAuth', data);
    redirect('home');
  },

  logout({ commit }) {
    return axios.post(base_url('logout')).then(() => {
      commit('unsetAuth');
      location.reload();
    });
  }
};
