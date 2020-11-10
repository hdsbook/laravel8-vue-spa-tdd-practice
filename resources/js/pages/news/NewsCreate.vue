<template>
  <Form @submit="createNews"
    defaultTitle=""
    defaultContent="">
    <Button slot="submit_btn" type="submit" class="success w-full text-lg">
      Create
    </Button>
  </Form>
</template>

<script>
import { mapActions } from 'vuex';
import Form from "./Form.vue";

export default {
  components: {
    Form,
  },
  methods: mapActions('news', ['createNews'])
}
</script>