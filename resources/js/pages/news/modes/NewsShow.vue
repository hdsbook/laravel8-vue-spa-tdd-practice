<template>
  <!-- 顯示某一消息 -->
  <div class="flex flex-col items-center">
    <Card v-bind="targetNews" />
    <Button @click.native="listNews">回最新消息</Button>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  computed: mapState('news', ['targetNews']),
  methods: mapActions('news', ['listNews']),
};
</script>

