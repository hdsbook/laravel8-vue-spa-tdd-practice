<template>
<div class="md:w-2/3 w-full mx-auto py-2">
  <NewsList v-if="mode === 'list'" />
  <NewsShow v-else-if="mode === 'show'" />
  <NewsEdit v-else-if="mode === 'edit'" />
</div>
</template>

<script>
import { mapState } from 'vuex';

import NewsShow from './modes/NewsShow.vue';
import NewsEdit from './modes/NewsEdit.vue';
import NewsList from './modes/NewsList.vue';

export default {
  components: {
    NewsShow,
    NewsEdit,
    NewsList,
  },
  computed: mapState('news', ['mode']),
};
</script>
