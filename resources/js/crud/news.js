class News {

    constructor() {
        this.apiFetchNews = 'hi';
    }

    fetchNews() {
        console.log('fetch news');
        return new Promise((resolve) => {
            resolve([
                {
                    id: 1,
                    title: 'test1',
                    content: 'content1',
                },
                {
                    id: 2,
                    title: 'test2',
                    content: 'content2',
                },
                {
                    id: 3,
                    title: 'test3',
                    content: 'content3',
                },
            ])
        })
    }

}

export default News;
