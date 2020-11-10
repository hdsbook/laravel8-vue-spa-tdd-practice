<template>
  <!-- 顯示某一消息 -->
  <div class="flex flex-col items-center">
    <Card v-bind="newsData" class="w-full" />
    <Button @click.native="listNews">回最新消息</Button>
  </div>
</template>

<script>
import Card from "../../components/Card.vue";
import Button from "../../components/Button.vue";
import { mapState, mapActions } from 'vuex';

export default {
  props: ['newsData'],
  components: {
    Card,
    Button
  },
  methods: mapActions('news', ['listNews']),
};
</script>

