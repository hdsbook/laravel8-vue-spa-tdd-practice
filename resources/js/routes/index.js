import news from './news';
import user from './user';
import form from './form';

import home from '../pages/Home.vue';

const routes = [
  ...news,
  ...user,
  ...form,
];

function dynamicImport(path) {
  return () => import(`@/pages/${path}`);
}
routes.map(route => {
  if (route.component) {
    route.component = dynamicImport(route.component);
  }
  return route;
});

routes.push({ path: '/', component: home, name: 'home' });
routes.push({ path: '*', redirect: '/' });

export default routes;