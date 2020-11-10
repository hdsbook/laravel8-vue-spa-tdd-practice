<template>
  <Form @submit="updateNews"
    :id="targetNews.id"
    :defaultTitle="targetNews.title"
    :defaultContent="targetNews.content">
    <Button slot="submit_btn" type="submit" class="info w-full text-lg">
      Update
    </Button>
  </Form>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import Form from "../Form.vue";

export default {
  components: {
    Form,
  },
  computed: mapState('news', ['targetNews']),
  methods: mapActions('news', ['updateNews']),
}
</script>