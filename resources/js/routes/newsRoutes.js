import NewsList from '../pages/news/NewsList.vue';
import NewsCreate from '../pages/news/NewsCreate.vue';

export default [
	{ path: '/news', component: NewsList, name: 'news.list' },
	{ path: '/news/create', component: NewsCreate, name: 'news.create' },
]
