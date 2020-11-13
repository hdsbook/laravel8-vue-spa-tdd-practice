require('./bootstrap');

import Vue from 'vue';
import router from './router';
import store from './store';

import './directives';
import './filters';
import './components';

const app = new Vue({
	el: '#app',
	data: {
		open: false,
	},
	router,
	store,
});
