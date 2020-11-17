import store from '../store';

export default async function (to, from, next) {
  if (!store.state['auth/check']) {
    try {
      await store.dispatch('auth/fetchUser');
    } catch (e) { }
  }
  next();
}