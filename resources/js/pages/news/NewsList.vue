<template>
  <div class="md:w-2/3 w-full mx-auto p-2">
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
          {{ news.created_at }}
          <Button :to="{ name: 'news.edit', params: { id: news.id } }" class="text-sm primary">
            Edit
          </Button>
          <Button :to="{ name: 'news.show', params: { id: news.id } }" class="text-sm ">
            Read
          </Button>
        </div>
      </div>
    </Card>

    <Pagination
      :data="newsPagination"
      @pagination-change-page="fetchNews"
      :show-disabled="true"
      align="center" />
  </div>
</template>

<script>
import moment from 'moment';
import { mapState, mapActions, mapGetters } from 'vuex';

export default {
  computed: {
    ...mapState('news', ['newsPagination']),
    ...mapGetters('news', ['allNews']),
  },
  methods: mapActions('news', [
    'fetchNews',
    'deleteNews',
  ]),
  mounted() {
    this.fetchNews();
  },
};
</script>
