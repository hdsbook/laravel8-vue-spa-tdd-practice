require('./bootstrap');

import Vue from 'vue';
import router from './router';
import store from './store';

import './directives';
import './filters';
import './components';

import App from './components/App.vue';

const app = new Vue({
	el: '#app',
	router,
	store,
	render: h => h(App),
});
