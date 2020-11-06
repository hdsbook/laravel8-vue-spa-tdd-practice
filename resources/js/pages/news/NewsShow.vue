<template>
  <div class="flex flex-col items-center">
    <Card v-bind="news" class="md:w-2/3" />
    <router-link to="/news">
      <Button>回最新消息</Button>
    </router-link>
  </div>
</template>

<script>
import Card from "../../components/Card";
import Button from "../../components/Button";
import NewsApi from "../../apis/NewsApi";

export default {
  components: {
    Card,
    Button
  },
  data: () => ({
    news: {}
  }),
  // async beforeRouteEnter (to, from, next) {
  //     console.log(to.params.id);
  //     console.log('hi' + to.params.id);
  //     // try {
  //     //     const { data } = await axios.post(`/api/email/verify/${to.params.id}?${qs(to.query)}`)
  //     //     next(vm => { vm.success = data.status })
  //     // } catch (e) {
  //     //     next(vm => { vm.error = e.response.data.status })
  //     // }
  // },
  mounted() {
    new NewsApi()
      .fetchNews(this.$route.params.id)
      .then((news) => this.news = news);
  },
};
</script>

