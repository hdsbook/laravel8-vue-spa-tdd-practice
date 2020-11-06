import NewsList from '../pages/news/NewsList.vue';
import NewsShow from '../pages/news/NewsShow.vue';

export default [
	{ path: '/news', component: NewsList, name: 'news' },
	{ path: '/news/show/:id', component: NewsShow, name: 'news' },
]
