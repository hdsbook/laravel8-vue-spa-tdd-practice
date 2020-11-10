<template>
  <NewsForm @submit="updateNews"
    :id="newsData.id"
    :defaultTitle="newsData.title"
    :defaultContent="newsData.content">
    <Button slot="submit_btn" type="submit" class="info w-full text-lg">
      Update
    </Button>
  </NewsForm>
</template>

<script>
import { mapActions } from 'vuex';
import NewsForm from "./NewsForm.vue";

export default {
  props: ['newsData'],
  components: {
    NewsForm,
  },
  methods: mapActions('news', ['updateNews'])
}
</script>