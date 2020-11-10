<template>
  <!-- 顯示某一消息 -->
  <div class="flex flex-col items-center">
    <Card v-bind="newsData" class="w-full" />
    <Button @click.native="listNews">回最新消息</Button>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  props: ['newsData'],
  methods: mapActions('news', ['listNews']),
};
</script>

