require('./bootstrap');

import Vue from 'vue';
import router from './router';
// import router, {routes} from './router';
// console.log(routes);

const app = new Vue({
    el: '#app',
    data: {
        open: false,
    },
    router
});
