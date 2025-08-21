<!-- @format -->

<template>
  <main id="wrapper">
    <div class="container">
        <h1>{{ title }}</h1>
        <p class="my-8">{{ message }}</p>
        <a href="/">Go Home</a>
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
