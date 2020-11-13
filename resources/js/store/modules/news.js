import { formatObjArrayDate } from '../../plugins/moment';

import API from '../../api/news';
import { redirect } from '../../router';

export default {
  namespaced: true,

  state: () => ({
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
    setNewsPagination: (state, payload) => state.newsPagination = payload,
  },

  actions: {
    fetchNews({ commit, getters }, page = null) {
      page = page || getters.currentPage;
      return API.fetchNews(page)
        .then(res => {
          res.data = formatObjArrayDate(
            res.data,
            'created_at',
            'YYYY-MM-DD HH:MM'
          );
          commit('setNewsPagination', res);
        });
    },
    fetchNewsById({ getters }, id) {
      const news = getters.allNews.find(news => news.id == id);
      return news ? news : API.fetchNewsById(id);
    },
    createNews({ dispatch }, newsData) {
      return API.createNews(newsData)
        .then(() => dispatch('fetchNews'))
        .then(() => redirect('news'));
    },
    updateNews({ dispatch }, newsData) {
      return API.updateNews(newsData)
        .then(() => dispatch('fetchNews'))
        .then(() => redirect('news'));
    },
    deleteNews({ dispatch }, id) {
      return API.deleteNews(id)
        .then(() => dispatch('fetchNews'))
        .then(() => redirect('news'));
    },
  },
};
