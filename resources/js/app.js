require('./bootstrap');

import Vue from 'vue';
import router from './router';
import store from './store/index';

import '@/components'; // globally register commonly used components

const app = new Vue({
	el: '#app',
	data: {
		open: false,
	},
	router,
	store,
});
