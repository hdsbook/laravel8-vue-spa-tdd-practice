<template>
  <component :is="tagType" :to="to" :type="type" class="btn">
    <slot />
  </component>
</template>

<script>
export default {
  props: {
    to: {
      required: false,
    },
    type: {
      required: false,
    }
  },
  computed: {
    tagType() {
      // if has attribute `to`: be a router-link
      // else : be a button
      return this.to ? 'router-link' : 'button';
    }
  }
}
</script>
