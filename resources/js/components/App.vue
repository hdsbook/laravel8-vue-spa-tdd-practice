<template>
<div id="app" class="min-h-screen bg-gray-100">
    <!-- Page Heading -->
    <header class="bg-white shadow sticky w-full">
        <Navbar />
    </header>

    <!-- Page Content -->
    <main>
        <router-view></router-view>
    </main>
</div>
</template>

<script>
import Navbar from './Navbar';

export default {
  components: {
    Navbar,
  }

}
</script>