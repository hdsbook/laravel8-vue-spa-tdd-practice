<template>
  <div class="flex flex-col items-center p-3">
    <div class="md:w-2/3 w-full">
      <!-- create news button -->
      <div class="text-right">
        <Button class="success">Create news</Button>
      </div>

      <!-- news cards -->
      <Card v-for="news in allNews" :key="news.id" v-bind="news">
        <template slot="card_body" >
          <div class="truncate">{{ news.content }}</div>
        </template>

        <template slot="card_footer">
          <div class="card-footer">
            <Button class="danger">Delete</Button>
            <div class="float-right">
              <Button class="primary">Edit</Button>
              <router-link :to="{ path: '/news/show/' + news.id }">
                <Button>Read</Button>
              </router-link>
            </div>
          </div>
        </template>
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
  mounted() {
    new NewsApi().fetchNews().then((allNews) => {
      this.allNews = allNews;
    });
  },
};
</script>
