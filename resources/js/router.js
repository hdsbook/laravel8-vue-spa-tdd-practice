import Vue from 'vue';
import Router from 'vue-router';
import home from './pages/Home.vue';

// Import routes of each page
import newsRoutes from './routes/newsRoutes';

Vue.use(Router);

const routes = [
	...newsRoutes,
];
routes.push({ path: '/', component: home, name: 'home' })
routes.push({ path: '*', redirect: '/' })

const router = new Router({
	mode: 'history',
	routes
})

export { routes };
export default router;
