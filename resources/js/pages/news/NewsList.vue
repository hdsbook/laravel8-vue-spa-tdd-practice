<template>
<div class="md:w-2/3 w-full mx-auto py-2">
  <!-- 新增按扭 -->
  <div class="text-right">
    <Button to="/news/create" class="success">
      Create news
    </Button>
  </div>

  <div v-if="allNews.length == 0" class="text-center p-4">載入中…</div>

  <!-- 消息列表 -->
  <Card v-for="news in allNews" :key="news.id" v-bind="news">
    <div slot="card_body" class="card-body truncate">
      {{ news.content }}
    </div>

    <div slot="card_footer" class="card-footer">
      <Button class="text-sm danger"
        @click.native="deleteNews(news.id)">
        Delete
      </Button>
      <div class="float-right">
        <Button :to="{ path: '/news/edit/' + news.id }" class="text-sm primary">
          Edit
        </Button>
        <Button :to="{ path: '/news/show/' + news.id }" class="text-sm ">
          Read
        </Button>
      </div>
    </div>
  </Card>
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
    new NewsApi().fetchNews()
      .then(allNews => this.allNews = allNews);
  },
  methods: {
    deleteNews(id) {
      new NewsApi().deleteNews(id).then(() => {
        this.allNews = this.allNews.filter(news => news.id !== id)
      })
    }
  },
};
</script>
