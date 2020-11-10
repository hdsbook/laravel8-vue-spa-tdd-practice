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
import NewsForm from "./NewsForm.vue";
import Button from "../../components/Button.vue";
import { mapActions } from 'vuex';

export default {
  components: {
    NewsForm,
    Button,
  },
  methods: mapActions('news', ['createNews'])
}
</script>