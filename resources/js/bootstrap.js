window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// set default headers (csrf/api token)
const csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
const apiMetaTag = document.querySelector('meta[name="api-token"]');
csrfMetaTag
  ? window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMetaTag.getAttribute('content')
  : console.log('csrf token not found');
apiMetaTag
  ? window.axios.defaults.headers.common['Authorization'] = "Bearer " + apiMetaTag.getAttribute('content')
  : console.log('api token not found');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
