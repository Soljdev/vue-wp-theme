<!-- @format -->

<template>
  <main class="min-h-[80vh] flex py-32" id="wrapper">
    <div class="container flex items-end justify-end">
      <div
        class="content-frame"
        :style="`--post-bg: url(${site.template_url}/img/bg.png)`"
      >
        <h1 class="text-right text-white font-bold mb-12">{{ title }}</h1>
        <p class="mb-8">{{ message }}</p>
        <a class="text-cf-primary" href="/">Go Home</a>
      </div>
    </div>
  </main>
</template>

<script>
  export default {
    components: {},
    data() {
      return {
        title: '404 - Page Not Found',
        message: 'Apparently nothing exists at this location.',
        site: this.$store.state.site,
      };
    },
    created() {
      this.$store.dispatch('updateDocTitle', {
        parts: ['Page not found', this.$store.state.site.name],
      });
    },
  };
</script>
