class NewsApi {

  fetchNews() {
    return axios.get(base_url('api/news/fetch')).then(res => res.data);
  }

  fetchNewsById(id) {
    return axios.get(base_url('api/news/find'), {
      params: { id: id }
    }).then(res => res.data);
  }

  createNews({ title, content }) {
    return axios.post(base_url('api/news'), {
      title: title,
      content: content,
    }).then(res => res.data);
  }

  updateNews({ id, title, content }) {
    return axios.post(base_url(`api/news/${id}`), {
      _method: 'patch',
      title: title,
      content: content,
    })
  }

  deleteNews(id) {
    return axios.delete(`api/news/${id}`);
  }
}

export default NewsApi;