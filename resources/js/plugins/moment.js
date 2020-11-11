import moment from 'moment';

export function formatObjDate(object, keys, formatString) {
  if (typeof (keys) === 'string') {
    keys = [keys];
  }
  keys.forEach(key => {
    if (object[key]) {
      object[key] = moment(object[key]).format(formatString);
    }
  });
  return object;
}

export function formatObjArrayDate(array, keys, formatString) {
  array.map(item => formatObjDate(item, keys, formatString));
  return array;
}

export default moment;