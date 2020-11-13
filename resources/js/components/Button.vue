<template>
  <component :is="tagType" :to="to" :type="type" class="btn">
    <slot />
  </component>
</template>

<script>
export default {
  name: "Button",
  props: {
    to: {
      type: [String, Object],
      default: '',
      required: false,
    },
    type: {
      type: String, // button type: (button, submit ...)
      default: '',
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
