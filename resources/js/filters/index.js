import Vue from 'vue';
import moment from 'moment';

// {{ data.created_at | dateformat('YYYY-MM-DD') }}
Vue.filter('dateformat', (date, format = "YYYY-MM-DD HH:mm") => {
  return moment(date).format(format);
});