<template>
<div class="md:w-2/3 w-full mx-auto">
  <form @submit.prevent="submitFunc" class="bg-white p-5 my-5 rounded shadow grid grid-cols-1 gap-4">
    <div class="col-span-1">
      <input type="text" class="form-control"
        v-model="newsData.title"
        ref="titleInput"
        placeholder="Title" required>
    </div>
    <div class="col-span-1">
      <textarea cols="30" rows="8" class="form-control"
        v-model="newsData.content"
        placeholder="Content" required>
      </textarea>
    </div>
    <slot name="submit_btn">

    </slot>
  </form>
  <div class="text-center">
    <Button to="/news">回最新消息</Button>
  </div>
</div>
</template>

<script>
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";

export default {
  props: ['title', 'content'],
  components: {
    Card,
    Button,
  },
  mounted() {
    this.$refs.titleInput.focus()
  },
  data() {
    return {
      newsData: {
        title: this.title ,
        content: this.content ,
      }
    }
  },
  methods: {
    submitFunc() {
      this.$emit('submit', this.newsData)
    }
  }
}
</script>

<style lang="sass" scoped>
.form-control
  @apply p-3 rounded w-full
  @apply border-2 border-gray-400
  &:md
    @apply text-xl
</style>