import News from '../pages/news/News.vue';
import NewsList from '../pages/news/NewsList.vue';
import NewsCreate from '../pages/news/NewsCreate.vue';
import NewsShow from '../pages/news/NewsShow.vue';
import NewsEdit from '../pages/news/NewsEdit.vue';

export default [
	{ path: '/news', component: NewsList, name: 'news.list' },
	{ path: '/news/create', component: NewsCreate, name: 'news.create' },
	{ path: '/news/show/:id', component: NewsShow, name: 'news.show' },
	{ path: '/news/edit/:id', component: NewsEdit, name: 'news.edit' },
]
