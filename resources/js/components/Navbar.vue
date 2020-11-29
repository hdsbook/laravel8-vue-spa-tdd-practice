<template>
<div class="antialiased bg-gray-100 dark-mode:bg-gray-900">
<div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
<div class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
  <div class="flex flex-row items-center justify-between p-4">
    <router-link to="/" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        Laravel8 Vue SPA TDD practice
    </router-link>
    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="navOpen = !navOpen">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path v-show="!navOpen" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path v-show="navOpen" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
  </div>
  <nav :class="{'flex': navOpen, 'hidden': !navOpen}" class="flex-col flex-grow pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
    <router-link to="/news" class="nav-link">
      最新消息
    </router-link>
    <!-- <router-link to="/forms" class="nav-link">
      表單列表
    </router-link> -->

    <template v-if="isAuth">
      <div class="relative">
        <button @blur="dropDownOpen = false" @click="dropDownOpen = !dropDownOpen" class="flex flex-row items-center w-full px-4 py-2 m-1 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
          <span>
            {{ user.name }}
          </span>
          <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': dropDownOpen, 'rotate-0': !dropDownOpen}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div v-show="dropDownOpen" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
          <div class="block px-4 py-2 text-xs text-gray-400">
            {{ userRoles }}
            <!-- Auth::user()->userRoles->implode('role', '、')) -->
          </div>
          <a class="dropdown-option" @mousedown="profile">
            個人資料
          </a>

          <div class="border-t border-gray-100"></div>

          <div class="dropdown-option" @mousedown="logout">
            Logout
          </div>
        </div>
        </div>
      </div>
    </template>
    <template v-if="!isAuth">
      <router-link :to="{name: 'login'}" class="nav-link">
        Login
      </router-link>
      <a :href="registerUrl" class="nav-link">
        Register
      </a>
    </template>
  </nav>
</div>
</div>
</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  data: () => ({
    navOpen: false,
    dropDownOpen: false,
    registerUrl: base_url('register'),
    profileUrl: base_url('user/profile'),
  }),
  computed: mapGetters('auth', ['user', 'userRoles', 'isAuth']),
  methods: {
    ...mapActions('auth', ['logout']),
    profile() {
      location.href = this.profileUrl;
    }
  }
}
</script>

<style lang="sass" scoped>
.nav-link
  @apply px-4 py-2 m-1
  @apply text-sm font-semibold
  @apply bg-transparent rounded-lg
  &:hover
    @apply text-gray-900 bg-gray-200
  &:focus
    @apply text-gray-900 bg-gray-200 outline-none shadow-outline
  &:dark-mode
    @apply bg-transparent text-gray-200
    &:focus,
    &:hover
      @apply bg-gray-600 text-white
.dropdown-option
  @apply cursor-pointer block
  @apply px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg
  &:md
    @apply mt-0
  &:hover
    @apply text-gray-900 bg-gray-200
  &:focus
    @apply text-gray-900 bg-gray-200 outline-none shadow-outline

  // dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200
</style>