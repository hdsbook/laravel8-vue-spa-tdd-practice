<template>
  <Form @submit="updateNews"
    :id="newsData.id"
    :defaultTitle="newsData.title"
    :defaultContent="newsData.content">
    <Button slot="submit_btn" type="submit" class="info w-full text-lg">
      Update
    </Button>
  </Form>
</template>

<script>
import { mapActions } from 'vuex';
import Form from "./Form.vue";

export default {
  components: {
    Form
  },
  data: () => ({
    newsData: {}
  }),
  methods: mapActions('news', [
    'fetchNewsById',
    'updateNews'
  ]),
  created() {
    this.fetchNewsById(this.$route.params.id)
      .then(news => this.newsData = news);
  }
}
</script>