import NewsApi from '../../apis/NewsApi';
import router from '../../router';

const API = new NewsApi();

export default {
  namespaced: true,
  state: () => ({
    allNews: []
  }),
  mutations: {
    setNews(state, allNews) {
      state.allNews = allNews;
    }
  },
  actions: {
    fetchNews({ commit }) {
      return API.fetchNews()
        .then(allNews => commit('setNews', allNews));
    },
    createNews(context, newsData) {
      return API.createNews(newsData)
        .then(() => router.push({ name: 'news.list' }));
    },
    deleteNews({ commit, state }, id) {
      return API.deleteNews(id)
        .then(() => commit('setNews', state.allNews.filter(news => news.id !== id)));
    }
  },
  getters: {}
};
