<template>
  <button class="btn"><slot /></button>
</template>

<style lang="sass" scoped>
.btn
  @apply px-3 py-1 m-1 text-sm font-semibold text-cool-gray-700
  @apply border box-border rounded inline-block cursor-pointer select-none
  @apply duration-100
  &:hover
    @apply bg-gray-200
  &.success
    @apply border-green-500 text-green-500
    &:hover
      @apply bg-green-500 text-white
  &.primary
    @apply border-blue-500 text-blue-500
    &:hover
      @apply bg-blue-500 text-white
  &.danger
    @apply border-red-500 text-red-500
    &:hover
      @apply bg-red-500 text-white
</style>
