<template>
  <div class="card">
    <!-- header -->
    <div class="card-header">
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
  props: ["title", "content"],
};
</script>