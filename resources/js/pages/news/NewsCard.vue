<template>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ title }}</h1>
        </div>
        <div class="card-body overflow-hidden h-8">
            {{ content }}
        </div>
        <div class="card-footer">
            <Button>Read</Button>
            <Button>Edit</Button>
            <Button>Delete</Button>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import Button from '../../components/Button.vue';

export default {
    components: {
        Button,
    },
    props: ["title", "content"],
}
</script>

<style lang="sass" scoped>
    .card
        @apply bg-white bg-opacity-50 m-2 rounded-lg shadow-md
    .card-title
        @apply px-3 pt-3 pb-1 text-xl font-bold
    .card-body
        @apply px-3 truncate
    .card-footer
        @apply px-3 border-t text-right
</style>
