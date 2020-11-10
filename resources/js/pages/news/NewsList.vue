<template>
<div class="md:w-2/3 w-full mx-auto py-2">
  <!-- show -->
  <NewsShow v-if="mode === 'show'" :newsData="targetNews" />

  <!-- edit -->
  <NewsEdit v-else-if="mode === 'edit'" :newsData="targetNews" />

  <!-- list -->
  <template v-else-if="mode === 'list'">
    <div class="text-right">
      <Button to="/news/create" class="success">Create news</Button>
    </div>

    <div v-if="!allNews.length" class="text-center p-4">
      載入中…
    </div>

    <Card v-for="news in allNews" :key="news.id" v-bind="news">
      <div slot="body" class="card-body truncate">
        {{ news.content }}
      </div>

      <div slot="footer" class="card-footer">
        <Button @click.native="deleteNews(news.id)" class="text-sm danger">
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

    <Pagination
      :data="newsPagination"
      @pagination-change-page="fetchNews"
      :show-disabled="true"
      align="center"
      size="default" />
    <!--
      Pagination settings (https://www.npmjs.com/package/laravel-vue-pagination)
        align: left, center, right
        size: default, small, large
    -->
  </template>
</div>
</template>

<script>
import Vue from "vue";
import { mapState, mapActions, mapMutations, mapGetters } from 'vuex';

import NewsShow from './NewsShow.vue';
import NewsEdit from './NewsEdit.vue';
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";

import Pagination from 'laravel-vue-pagination';

export default {
  components: {
    Card,
    Button,
    NewsShow,
    NewsEdit,
    Pagination
  },
  computed: {
    ...mapState('news', [
      'mode',
      'targetNews',
      'newsPagination',
    ]),
    ...mapGetters('news', [
      'allNews',
    ]),
  },
  methods: {
    ...mapMutations('news', [
      'setMode',
    ]),
    ...mapActions('news', [
      'fetchNews',
      'deleteNews',
      'editNews',
      'showNews',
    ]),
  },
  mounted() {
    this.fetchNews();
  },
};
</script>
