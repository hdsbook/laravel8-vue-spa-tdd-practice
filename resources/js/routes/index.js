import home from '../pages/Home.vue';
import news from './news';

const routes = [
  ...news,
];
routes.push({ path: '/', component: home, name: 'home' });
routes.push({ path: '*', redirect: '/' });

export default routes;