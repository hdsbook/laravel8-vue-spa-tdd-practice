<template>
  <component
    :is="page"
    v-bind="pageData"
    @show="show">
  </component>
</template>

<script>
import NewsList from './NewsList.vue';
import NewsShow2 from './NewsShow2.vue';
import NewsApi from '../../apis/NewsApi';

export default {
  components: {
    NewsList
  },
  data: (() => ({
    page: NewsList,
    pageData: [],
  })),
  created() {
    this.list();
  },
  methods: {
    list() {
      new NewsApi().fetchNews()
        .then(allNews => {
          this.pageData = { allNews };
          this.page= NewsList;
        })
    },
    show(news) {
      this.pageData = { news };
      this.page = NewsShow2;
    }
  }

}
</script>