<template>
    <div>
        <h1>{{ news.title }}</h1>
        <p>{{ news.content }}</p>
    </div>
</template>

<script>
import Vue from 'vue';

export default {
    props: ["news"],
    mounted() {
        Vue.nextTick(() => {
            console.log(this.test);
        })
    }
}
</script>
