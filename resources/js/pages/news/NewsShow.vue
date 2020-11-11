<template>
  <!-- 顯示某一消息 -->
  <div class="md:w-2/3 w-full mx-auto p-2 flex flex-col items-center">
    <Card v-bind="newsData" />
    <Button :to="{ name: 'news' }">回最新消息</Button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  data: () => ({
    newsData: {}
  }),
  methods: mapActions('news', ['fetchNewsById']),
  created() {
    this.fetchNewsById(this.$route.params.id)
      .then(news => this.newsData = news);
  }
};
</script>

