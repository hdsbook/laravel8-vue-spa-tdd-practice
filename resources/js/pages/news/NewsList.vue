<template>
    <div class="flex flex-col items-center px-3">
        <NewsCard
            v-for="news in newsList"
            :key="news.id"
            :news="news" />
    </div>
</template>

<script>
import Vue from 'vue';
import NewsCard from './NewsCard.vue';
import NewsApi from '../../api/NewsApi';

export default {
    components: {
        NewsCard,
    },
    data() {
        return {
            newsApi: null,
            newsList: [],
        };
    },
    mounted() {
        this.newsApi = new NewsApi();
        this.newsApi.fetchNews().then(allNews => {
            this.newsList = allNews;
        });
    },
}
</script>
