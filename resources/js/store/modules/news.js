import newsApi from '../../apis/newsApi';
import router from '../../router';

const API = new newsApi();

export default {
  namespaced: true,
  state: () => ({
    mode: 'list',  // list、show、edit
    targetNews: null,
    newsPagination: {},
  }),

  getters: {
    allNews: state => state.newsPagination.data || [],
  },

  mutations: {
    // setters
    setNewsPagination: (state, newsPagination) => state.newsPagination = newsPagination,
    setTargetNews: (state, payload) => state.targetNews = payload,
    setMode: (state, payload) => state.mode = payload,
  },

  actions: {
    // list, edit, show
    listNews({ commit }) {
      commit('setTargetNews', null);
      commit('setMode', 'list');
      if (router.currentRoute.name !== 'news.list') {
        router.push({ name: 'news.list' });
      }
    },
    editNews({ commit }, news) {
      commit('setTargetNews', news);
      commit('setMode', 'edit');
    },
    showNews({ commit }, news) {
      commit('setTargetNews', news);
      commit('setMode', 'show');
    },

    // fetch, create, update, delete
    fetchNews({ commit, dispatch }, page = 1) {
      return API.fetchNews(page)
        .then(res => commit('setNewsPagination', res.data))
        .then(() => dispatch('listNews'));
    },
    createNews({ dispatch }, newsData) {
      return API.createNews(newsData)
        .then(() => dispatch('fetchNews'));
    },
    updateNews({ dispatch }, newsData) {
      return API.updateNews(newsData)
        .then(() => dispatch('fetchNews'));
    },
    deleteNews({ dispatch }, id) {
      return API.deleteNews(id)
        .then(() => dispatch('fetchNews'));
    },
  },
};
