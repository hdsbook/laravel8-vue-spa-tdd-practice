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
    createNews(context, newsData) {
      return API.createNews(newsData)
        .then(() => redirect('news'));
    },
    updateNews(context, newsData) {
      return API.updateNews(newsData)
        .then(() => redirect('news'));
    },
    deleteNews(context, id) {
      return API.deleteNews(id)
        .then(() => redirect('news'));
    },
  },
};
