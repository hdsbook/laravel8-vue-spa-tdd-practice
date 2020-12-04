import axios from 'axios';
import store from '../store';
import router from '../router';
import { swalError, swalWarning } from './swal';

// Request interceptors
const requestDoneInterceptor = request => {
  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

  // CSRF TOKEN
  const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
  csrfMetaTag
    ? axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfMetaTag.getAttribute('content')
    : console.log('csrf token not found');

  // API TOKEN
  const token = store.state['auth']['token'];
  axios.defaults.headers.common['Authorization'] = "Bearer " + token;

  return request;
};
const requestErrorInterceptor = error => Promise.reject(error);

// Response interceptors
const responseDoneInterceptor = response => response;
const responseErrorInterceptor = error => {
  const { status, data } = error.response;

  if (status == 422) {
    let errorMessage = Object.values(data.errors)
      .map(dataErrors => dataErrors.join("<br>"))
      .join("<br>");

    swalError(data.message, errorMessage);
  }

  if (status >= 500) {
    swalError('Oops...', 'Something went wrong!');
  }

  // Session/Token expired
  if (status === 401 && store.getters['auth/check']) {
    swalWarning(
      'Unauthorzed',
      'Session expired, please relogin'
    ).then(() => {
      store.dispatch('auth/logout')
        .then(() => router.push({ name: 'login' }));
    });
  }

  return Promise.reject(error);
};


axios.interceptors.request.use(
  requestDoneInterceptor,
  requestErrorInterceptor
);
axios.interceptors.response.use(
  responseDoneInterceptor,
  responseErrorInterceptor
);

const api = axios.create({ baseURL: base_url('api') });
api.interceptors.request.use(
  requestDoneInterceptor,
  requestErrorInterceptor
);
api.interceptors.response.use(
  responseDoneInterceptor,
  responseErrorInterceptor
);

export { api };
export default axios;