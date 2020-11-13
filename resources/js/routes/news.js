export default [
	{ name: 'news', path: '/news', component: 'news/NewsList.vue' },
	{ name: 'news.create', path: '/news/create', component: 'news/NewsCreate.vue' },
	{ name: 'news.edit', path: '/news/:id/edit', component: 'news/NewsEdit.vue' },
	{ name: 'news.show', path: '/news/:id', component: 'news/NewsShow.vue' },
];
