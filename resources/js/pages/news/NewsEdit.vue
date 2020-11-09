<template>
  <NewsForm @submit="updateNews" :title="1" :content="2">
    <Button slot="submit_btn" type="submit" class="info w-full text-lg">
      Update
    </Button>
  </NewsForm>
</template>

<script>
import NewsForm from "./NewsForm.vue";
import Button from "../../components/Button.vue";
import NewsApi from '../../apis/NewsApi';

export default {
  components: {
    NewsForm,
    Button,
  },
  methods: {
    updateNews(newsData) {
      new NewsApi().updateNews(newsData);
    }
  }
}
</script>