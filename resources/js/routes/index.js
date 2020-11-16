import home from '../pages/Home.vue';

function dynamicImport(path) {
  return () => import(`@/pages/${path}`);
}

// import routes dynamically
const requireContext = require.context('./modules', false, /.*\.js$/);
const routes = requireContext
  .keys()
  .map(file => requireContext(file).default)
  .reduce((routes, fileRoutes) => [...routes, ...fileRoutes], [])
  .map(route => {
    if (route.component) {
      route.component = dynamicImport(route.component);
    }
    return route;
  });

routes.push({ path: '/', component: home, name: 'home' });
routes.push({ path: '*', redirect: '/' });

// console.log(routes);
export default routes;