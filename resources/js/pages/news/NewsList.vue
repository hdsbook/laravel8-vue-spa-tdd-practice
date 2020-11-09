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
import { mapState, mapActions } from 'vuex';
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";

export default {
  components: {
    Card,
    Button,
  },
  computed: mapState('news', {
    allNews: state => state.allNews,
  }),
  created() {
    this.$store.dispatch('news/fetchNews');
  },
  methods: mapActions('news', {
    deleteNews: 'deleteNews',
  }),
};
</script>
