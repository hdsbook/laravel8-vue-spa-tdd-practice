<template>
  <div>
    <NewsForm @submit="createNews" defaultTitle="" defaultContent="">
      <Button slot="submit_btn" type="submit" class="success w-full text-lg">
        Create
      </Button>
    </NewsForm>
  </div>
</template>

<script>
import NewsForm from "./NewsForm.vue";
import Button from "../../components/Button.vue";
import NewsApi from '../../apis/NewsApi';
import { mapActions } from 'vuex';

export default {
  components: {
    NewsForm,
    Button,
  },
  methods: mapActions('news', ['createNews'])
}
</script>

<style lang="sass" scoped>
.form-control
  @apply p-3 rounded w-full
  @apply border-2 border-gray-400
  &:md
    @apply text-xl
</style>