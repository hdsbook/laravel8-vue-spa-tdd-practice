import axios, { api } from '../plugins/axios';

export default {

  fetchNews(page = 1) {
    return api.get('news/fetch', {
      params: { page: page },
    }).then(res => res.data);
  },

  fetchNewsById(id) {
    return api.get('news/find', {
      params: { id: id }
    }).then(res => res.data);
  },

  createNews({ title, content }) {
    return api.post('news', {
      title: title,
      content: content,
    }).then(res => res.data);
  },

  updateNews({ id, title, content }) {
    return api.post(`news/${id}`, {
      _method: 'patch',
      title: title,
      content: content,
    });
  },

  deleteNews(id) {
    return api.delete(`news/${id}`);
  },
};
