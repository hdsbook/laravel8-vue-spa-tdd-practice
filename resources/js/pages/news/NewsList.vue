<template>
  <div class="flex flex-col items-center p-3">
    <div class="md:w-2/3 w-full">
      <!-- 新增按扭 -->
      <div class="text-right">
        <Button class="success">Create news</Button>
      </div>

      <!-- 消息列表 -->
      <Card v-for="news in allNews" :key="news.id" v-bind="news">
        <!-- card body -->
        <div slot="card_body" class="card-body truncate">
          {{ news.content }}
        </div>

        <!-- card footer -->
        <div slot="card_footer" class="card-footer">
          <Button class="danger">Delete</Button>
          <div class="float-right">
            <Button class="primary">Edit</Button>
            <Button :to="{ path: '/news/show/' + news.id }">
              Read
            </Button>
          </div>
        </div>
      </Card>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";

import NewsApi from "../../apis/NewsApi";

export default {
  components: { Card, Button },
  data: () => ({
    allNews: [],
  }),
  created() {
    new NewsApi().fetchNews().then((allNews) => {
      this.allNews = allNews;
    });
  },
};
</script>
