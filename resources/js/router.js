import Vue from 'vue';
import Router from 'vue-router';
import routes from './routes';

import checkAuth from './middlewares/checkAuth';

Vue.use(Router);

const router = new Router({
	mode: 'history',
	routes
})

router.beforeEach(checkAuth);

export function redirect(name, params = {}) {
	params
		? router.push({ name, params }).catch(() => { console.log('same route'); })
		: router.push({ name }).catch(() => { console.log('same route'); });
}

export default router;
