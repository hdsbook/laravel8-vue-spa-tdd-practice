<template>
    <div>
        <NewsBox
            v-for="news in newsList"
            :key="news.id"
            :news="news"
        />
    </div>
</template>

<script>
import Vue from 'vue';
import NewsBox from './NewsBox.vue';
import News from '../../crud/news';

export default {
    components: {
        NewsBox,
    },
    data() {
        return {
            crudObj: null,
            newsList: [],
        };
    },
    mounted() {
        this.crudObj = new News();
        this.crudObj.fetchNews().then(allNews => {
            this.newsList = allNews;
            console.log(this.newsList);
            // Vue.set(this.newsList, allNews);
            // console.log(this.newsList);
        });
    },
    // watch: {
    //     newsList(newVal) {
    //         console.log(newVal);
    //     }
    // },
}
</script>
