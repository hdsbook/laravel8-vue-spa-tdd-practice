import home from '../pages/Home.vue';
import news from './news';
import user from './user';
import form from './form';

const routes = [
  ...news,
  ...user,
  ...form,
];
routes.push({ path: '/', component: home, name: 'home' });
routes.push({ path: '*', redirect: '/' });

export default routes;