<!-- @format -->

<template>
</template>

<script>
  import ResponsiveImage from '../utility/ResponsiveImage.vue';

  export default {
    name: 'Footer',
    components: {
      ResponsiveImage,
    },
    props: {},
    data() {
      return {
        name: 'Footer',
        site: this.$store.state.site,
      };
    },
    computed: {
      logo() {
        if (this.site.logo) {
          return this.$store.getters.singleById({ type: 'media', id: this.site.logo });
        }
      },

      companies() {},
    },
    methods: {},
    created() {
      console.log('Footer.vue > created()', this);
    },
  };
</script>

<style>

</style>
