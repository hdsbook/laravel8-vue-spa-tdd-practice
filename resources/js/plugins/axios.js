import axios from 'axios';
import store from '../store';
import router from '../router';
import { quickAlert } from './swal';

// Request interceptor
axios.interceptors.request.use(request => {
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
});

// Response interceptor
axios.interceptors.response.use(
  response => response,
  error => {
    const { status, data } = error.response;

    if (status == 422) {
      let errorMessage = Object.values(data.errors).map(
        dataErrors => dataErrors.join("<br>")
      ).join("<br>");

      quickAlert({
        icon: 'error',
        title: data.message,
        text: errorMessage,
      });
    }

    if (status >= 500) {
      quickAlert({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
      });
    }

    // Session/Token expired
    if (status === 401 && store.getters['auth/check']) {
      quickAlert({
        icon: 'warning',
        title: 'Unauthorzed',
        text: 'Session expired, please relogin',
      }).then(() => {
        store.dispatch('auth/logout').then(() => {
          router.push({ name: 'login' });
        });
      });
    }

    return Promise.reject(error);
  }
);

export default axios;