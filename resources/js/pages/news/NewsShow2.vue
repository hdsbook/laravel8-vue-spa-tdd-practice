<template>
  <!-- 顯示某一消息 -->
  <div class="flex flex-col items-center">
    <div v-if="!news" class="text-center p-4">載入中…</div>
    <Card v-else v-bind="news" class="md:w-2/3" />
    <Button to="/news">回最新消息</Button>
  </div>
</template>

<script>
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";
import NewsApi from "../../apis/NewsApi";

export default {
  props: ['news'],
  components: {
    Card,
    Button
  },
};
</script>

