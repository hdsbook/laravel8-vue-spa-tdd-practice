import Vue from 'vue';

// v-focus
Vue.directive('focus', {
  inserted: el => el.focus()
});