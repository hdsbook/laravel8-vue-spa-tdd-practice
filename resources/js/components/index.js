import Vue from 'vue';
import Button from './Button.vue';
import Card from './Card.vue';

// components from 第三方套件
import Pagination from 'laravel-vue-pagination'; // https://www.npmjs.com/package/laravel-vue-pagination

// 全域註冊常用組件
[
  Button,
  Card,
].forEach(Component => {
  Vue.component(Component.name, Component);
});
Vue.component('Pagination', Pagination);