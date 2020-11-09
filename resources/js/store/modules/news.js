import NewsApi from '../../apis/NewsApi';
import router from '../../router';

const API = new NewsApi();

export default {
  namespaced: true,
  state: () => ({
    mode: 'list',  // list、show、edit
    allNews: [],
    selectedNews: {
      title: '',
      content: '',
    },
  }),
  mutations: {
    // setters
    setNews: (state, payload) => state.allNews = payload,
    setSelectedNews: (state, payload) => state.selectedNews = payload,
    resetSelectedNews: state => state.selectedNews = {
      title: '',
      content: '',
    },
    setMode: (state, payload) => {
      state.mode = payload;
    },
  },
  actions: {
    // fetch, create, update, delete
    fetchNews({ commit }) {
      return API.fetchNews()
        .then(allNews => commit('setNews', allNews));
    },
    createNews({ dispatch }, newsData) {
      return API.createNews(newsData)
        .then(() => dispatch('listNews'));
    },
    updateNews({ dispatch }, newsData) {
      return API.updateNews(newsData)
        .then(() => {
          dispatch('fetchNews')
            .then(() => dispatch('listNews'));
        })
    },
    deleteNews({ commit, state }, id) {
      return API.deleteNews(id)
        .then(() => commit('setNews', state.allNews.filter(news => news.id !== id)));
    },

    // list, edit, show
    listNews({ commit }) {
      commit('resetSelectedNews');
      commit('setMode', 'list');
      if (router.currentRoute.name !== 'news.list') {
        router.push({ name: 'news.list' });
      }
    },
    editNews({ commit }, news) {
      commit('setSelectedNews', news);
      commit('setMode', 'edit');
    },
    showNews({ commit }, news) {
      commit('setSelectedNews', news);
      commit('setMode', 'show');
    }
  },
  getters: {}
};
