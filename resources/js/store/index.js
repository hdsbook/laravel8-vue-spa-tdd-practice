import Vue from 'vue';
import Vuex from 'vuex';
import news from './modules/news';

Vue.use(Vuex);

const store = new Vuex.Store({
  modules: {
    news,
  }
});

export default store;