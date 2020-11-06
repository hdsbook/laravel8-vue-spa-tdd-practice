<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ title }}</h1>
        </div>
        <div class="card-body">
            {{ content }}
        </div>
        <div class="card-footer">
            <div class="btn">Read</div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';

export default {
    props: ["title", "content"],
}
</script>

<style lang="sass" scoped>
    .card
        @apply bg-white bg-opacity-50 m-2 rounded-lg shadow-md p-4
    .card-title
        @apply text-xl font-bold mb-2
</style>
