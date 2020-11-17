import store from '../store';

export default async function (to, from, next) {
  if (
    !store.state['auth']['user'] &&  // 無登入使用者資料 => 進行 fetchUser
    store.state['auth']['token']     // 但需要有 token 才能 fetchUser
  ) {
    try {
      await store.dispatch('auth/fetchUser');
    } catch (e) { }
  }
  next();
}