<template>
    <div class="news-card lg:w-2/3 w-full">
        <h1 class="news-card-title">{{ news.title }}</h1>
        <p>{{ news.content }}</p>
        <div class="btn">Read</div>
    </div>
</template>

<script>
import Vue from 'vue';

export default {
    props: ["news"],
}
</script>

<style lang="sass" scoped>
    .news-card
        @apply bg-white bg-opacity-50 m-2 rounded-lg shadow-md p-4
    .news-card-title
        @apply text-xl font-bold mb-2
</style>
