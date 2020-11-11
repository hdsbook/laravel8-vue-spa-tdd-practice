import NewsList from '../pages/news/NewsList.vue';
import NewsCreate from '../pages/news/NewsCreate.vue';
import NewsEdit from '../pages/news/NewsEdit.vue';
import NewsShow from '../pages/news/NewsShow.vue';

export default [
	{ path: '/news', component: NewsList, name: 'news' },
	{ path: '/news/create', component: NewsCreate, name: 'news.create' },
	{ path: '/news/:id/edit', component: NewsEdit, name: 'news.edit' },
	{ path: '/news/:id', component: NewsShow, name: 'news.show' },
];
