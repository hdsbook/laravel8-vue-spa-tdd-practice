<template>
    <button class="btn"><slot/></button>
</template>

<style lang="sass" scoped>
.btn
    @apply px-3 py-1 m-1 text-sm border rounded inline-block cursor-pointer select-none
.btn:hover
    @apply bg-gray-200
</style>
