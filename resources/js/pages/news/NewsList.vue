<template>
    <div>
        <NewsCard
            v-for="news in allNews"
            :key="news.id"
            v-bind="news" />
    </div>
</template>

<script>
import Vue from 'vue';
import NewsCard from './NewsCard.vue';
import Button from '../../components/Button.vue';

import NewsApi from '../../apis/NewsApi';

export default {
    components: {
        NewsCard,
        Button,
    },
    data() {
        return {
            newsApi: null,
            allNews: [],
        };
    },
    mounted() {
        this.newsApi = new NewsApi();
        this.newsApi.fetchNews().then(allNews => {
            this.allNews = allNews;
        });
    },
}
</script>
