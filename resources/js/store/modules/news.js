import API from '../../api/news';
import { redirect } from '../../router';

// state
export const state = {
  newsPagination: {},
};

// getters
export const getters = {
  allNews: state => state.newsPagination.data || [],
  currentPage: (state, getters) => {
    return (getters.allNews.length > 0)
      ? state.newsPagination.current_page
      : 1;
  }
};

// mutations
export const mutations = {
  setNewsPagination: (state, payload) => state.newsPagination = payload,
  setAllNews: (state, payload) => state.newsPagination.data = payload,
};

// actions
export const actions = {
  fetchNews({ commit, getters }, page = null) {
    page = page || getters.currentPage;
    return API.fetchNews(page)
      .then(res => commit('setNewsPagination', res));
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
  deleteNews({ dispatch, commit, getters }, id) {
    commit('setAllNews', getters.allNews.filter(news => news.id !== id))
    return API.deleteNews(id)
      .then(() => dispatch('fetchNews'))
      .then(() => redirect('news'));
  },
};
