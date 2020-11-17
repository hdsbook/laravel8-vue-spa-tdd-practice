<template>
  <div class="card">
    <!-- header -->
    <div class="card-header" v-if="title">
      <h1 class="card-title">{{ title }}</h1>
    </div>

    <!-- body -->
    <slot name="body">
      <div class="card-body">{{ content }}</div>
    </slot>

    <!-- footer -->
    <slot name="footer"/>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    title: { type: String, default: '' },
    content: { type: String, default: '' }
  },
};
</script>