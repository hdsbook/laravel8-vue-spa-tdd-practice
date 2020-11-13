<template>
<div class="md:w-2/3 w-full mx-auto">
  <form @submit.prevent="submitFunc" class="bg-white p-5 my-5 rounded shadow grid grid-cols-1 gap-4">

    <!-- Title -->
    <div class="col-span-1">
      <input type="text" class="form-control"
        v-model="submitData.title"
        v-focus
        placeholder="Title" required>
    </div>

    <!-- Content -->
    <div class="col-span-1">
      <textarea cols="30" rows="8" class="form-control"
        v-model="submitData.content"
        placeholder="Content" required>
      </textarea>
    </div>

    <!-- Submit button -->
    <slot name="submit_btn"></slot>
  </form>

  <div class="text-center">
    <Button :to="{ name: 'news' }">回最新消息</Button>
  </div>
</div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  props: {
    id: { type: Number, default: null, required: false },
    defaultTitle: { type: String, default: '' },
    defaultContent: { type: String, default: '' },
  },
  computed: {
    submitData() {
      return {
        id: this.id,
        title: this.defaultTitle,
        content: this.defaultContent,
      }
    }
  },
  methods: {
    submitFunc() {
      this.$emit('submit', this.submitData)
    },
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