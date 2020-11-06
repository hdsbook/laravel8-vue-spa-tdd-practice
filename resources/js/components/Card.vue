<template>
  <div class="card">
    <!-- header -->
    <div class="card-header">
      <h1 class="card-title">{{ title }}</h1>
    </div>

    <!-- body -->
    <slot name="card_body">
      <div class="card-body">{{ content }}</div>
    </slot>

    <!-- footer -->
    <slot name="card_footer"/>
  </div>
</template>

<script>
import Vue from "vue";

export default {
  props: ["title", "content"],
};
</script>

<style lang="sass" scoped>
.card
  @apply bg-white bg-opacity-50 m-2 rounded-lg shadow-md
  .card-title
    @apply px-3 leading-8 text-lg font-bold
  .card-body
    @apply px-3
  .card-footer
    @apply p-1 mt-2 border-t
</style>
