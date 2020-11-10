import News from '../pages/news/News.vue';
import NewsCreate from '../pages/news/NewsCreate.vue';

export default [
	{ path: '/news', component: News, name: 'news' },
	{ path: '/news/create', component: NewsCreate, name: 'news.create' },
];
