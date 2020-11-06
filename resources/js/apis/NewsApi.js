class NewsApi {

  constructor() {
    // this.apiFetchNews = route('news.fetch');
    this.apiFetchNews = base_url('api/news/fetch');
  }

  fetchNews(id) {
    return axios.get(this.apiFetchNews, {
      params: { id: id }
    }).then(res => res.data)
      .catch(error => console.log(error));
  }
}

export default NewsApi;
