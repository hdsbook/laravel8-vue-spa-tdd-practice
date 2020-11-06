class NewsApi {

    constructor() {
        // this.apiFetchNews = route('news.fetch');
        this.apiFetchNews = base_url('api/news');
    }

    fetchNews() {
        return axios.post(this.apiFetchNews)
            .then(res => res.data)
            .catch(error => {
                console.log(error)
            });
    }

}

export default NewsApi;
