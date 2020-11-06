<template>
  <div class="flex flex-col items-center">
    <Card v-bind="news" class="md:w-2/3" />
    <Button to="/news">回最新消息</Button>
  </div>
</template>

<script>
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";
import NewsApi from "../../apis/NewsApi";

export default {
  components: {
    Card,
    Button
  },
  data: () => ({
    news: {}
  }),
  created() {
    new NewsApi()
      .fetchNews(this.$route.params.id)
      .then((news) => this.news = news);
  },
};
</script>

