<template>
  <NewsForm @submit="createNews"
    defaultTitle=""
    defaultContent="">
    <Button slot="submit_btn" type="submit" class="success w-full text-lg">
      Create
    </Button>
  </NewsForm>
</template>

<script>
import { mapActions } from 'vuex';
import NewsForm from "./NewsForm.vue";

export default {
  components: {
    NewsForm,
  },
  methods: mapActions('news', ['createNews'])
}
</script>