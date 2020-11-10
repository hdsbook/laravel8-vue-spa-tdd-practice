import API from '../../api/news';
import router from '../../router';

export default {
  namespaced: true,
  state: () => ({
    mode: 'list',  // list、show、edit
    targetNews: null,
    newsPagination: {},
  }),

  getters: {
    allNews: state => state.newsPagination.data || [],
    currentPage: (state, getters) => {
      return (getters.allNews.length > 0)
        ? state.newsPagination.current_page
        : 1;
    }
  },

  mutations: {
    // setters
    setNewsPagination: (state, newsPagination) => state.newsPagination = newsPagination,
    setTargetNews: (state, payload) => state.targetNews = payload,
    setMode: (state, payload) => state.mode = payload,
  },

  actions: {
    changeMode({ commit }, [mode, news = null]) {
      // list(列表), edit(編輯), show(閱讀) 均在 `/news` 這個 route 下切換
      if (router.currentRoute.name !== 'news') {
        router.push({ name: 'news' });
      }
      commit('setTargetNews', news);
      commit('setMode', mode);
    },
    listNews: ({ dispatch }) => dispatch('changeMode', ['list']),
    editNews: ({ dispatch }, news) => dispatch('changeMode', ['edit', news]),
    showNews: ({ dispatch }, news) => dispatch('changeMode', ['show', news]),

    // fetch, create, update, delete
    fetchNews({ commit, dispatch, getters }, page = null) {
      page = page || getters.currentPage;
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
