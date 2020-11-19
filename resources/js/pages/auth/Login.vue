<script>
import { mapActions } from 'vuex';

export default {
  data: () => ({
    forgotPasswordUrl: base_url('forgot-password'),
    submitData: {
      email: '',
      password: '',
      remember: false,
    }
  }),
  methods: mapActions('auth', ['login']),
}
</script>

<template>
<div class="login-container font-sans text-gray-900 antialiased">
<form @submit.prevent="login(submitData)" class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
  <div>
    <label class="block font-medium text-sm text-gray-700" for="email">
      Email
    </label>
    <input class="form-input rounded-md shadow-sm block mt-1 w-full"
      v-model="submitData.email"
      v-focus
      id="email"
      type="email"
      name="email"
      required="required">
  </div>
  <div class="mt-4">
    <label class="block font-medium text-sm text-gray-700" for="password">
      Password
    </label>
    <input class="form-input rounded-md shadow-sm block mt-1 w-full"
      v-model="submitData.password"
      id="password"
      type="password"
      name="password"
      required="required">
  </div>
  <div class="mt-4 block">
    <label for="remember_me" class="flex items-center">
      <input class="form-checkbox"
        v-model="submitData.remember"
        id="remember_me"
        type="checkbox"
        name="remember">
      <span class="ml-2 text-sm text-gray-600">Remember me</span>
    </label>
  </div>
  <div class="mt-4 flex items-center justify-end">
    <a class="underline text-sm text-gray-600 hover:text-gray-900" :href="forgotPasswordUrl">
      Forgot your password?
    </a>

    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
      Login
    </button>
  </div>
</form>
</div>
</template>

<style lang="sass" scoped>
.login-container
  @apply min-h-screen flex flex-col items-center pt-6 bg-gray-100
  &:sm
    @apply justify-center pt-0

</style>