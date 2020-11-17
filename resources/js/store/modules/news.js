import API from '../../api/news';
import { redirect } from '../../router';

// state
export const state = {
  isLoading: true,
  newsPagination: {},
};

// getters
export const getters = {
  allNews: state => state.newsPagination.data || [],
  currentPage: (state, getters) => {
    return (getters.allNews.length > 0)
      ? state.newsPagination.current_page
      : 1; // when current page has no news, return to page 1
  }
};

// mutations
export const mutations = {
  setIsLoading: (state, payload) => state.isLoading = payload,
  setNewsPagination: (state, payload) => state.newsPagination = payload,
  removeNews: (state, id) => {
    state.newsPagination.data
      = state.newsPagination.data.filter(news => news.id !== id);
  },
};

// actions
export const actions = {
  fetchNews({ commit, getters, state }, page = null) {
    page = page || getters.currentPage;
    commit('setIsLoading', true);
    return API.fetchNews(page)
      .then(res => commit('setNewsPagination', res))
      .then(() => {
        commit('setIsLoading', false);
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
  deleteNews({ dispatch, commit }, id) {
    return API.deleteNews(id)
      .then(() => commit('removeNews', id))
      .then(() => dispatch('fetchNews'));
  },
};
