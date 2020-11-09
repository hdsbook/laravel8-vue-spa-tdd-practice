<template>
<div class="md:w-2/3 w-full mx-auto py-2">
  <!-- 新增按扭 -->
  <div class="text-right">
    <Button to="/news/create" class="success">Create news</Button>
  </div>

  <div v-if="!allNews.length" class="text-center p-4">載入中…</div>

  <!-- 最新消息列表 -->
  <template v-if="mode==='list'">
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
          <Button @click.native="editNews(news)" class="text-sm primary">
            Edit
          </Button>
          <Button @click.native="showNews(news)" class="text-sm ">
            Read
          </Button>
        </div>
      </div>
    </Card>
  </template>

  <!-- Show -->
  <NewsShow v-if="mode==='show'" />

  <!-- Edit -->
  <NewsEdit v-if="mode==='edit'" :newsData="selectedNews" />
</div>
</template>

<script>
import Vue from "vue";
import { mapState, mapActions, mapMutations } from 'vuex';

import NewsShow from './NewsShow.vue';
import NewsEdit from './NewsEdit.vue';
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";

export default {
  components: {
    Card,
    Button,
    NewsShow,
    NewsEdit,
  },
  computed: mapState('news', [
    'mode',
    'allNews',
    'selectedNews',
  ]),
  created() {
    this.$store.dispatch('news/fetchNews');
  },
  methods: {
    ...mapMutations('news', [
      'setSelectedNews',
      'setMode',
    ]),
    ...mapActions('news', [
      'deleteNews',
      'editNews',
      'showNews',
    ])
  },
};
</script>
