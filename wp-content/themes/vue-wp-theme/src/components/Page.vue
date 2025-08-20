<!-- @format -->

<template>
  <div>
    <main class="">
      <div v-if="page" class="container">
        <div class="w-full content-frame">
          <h1 v-html="page.title.rendered" class="mb-16"></h1>
          <div v-html="page.content.rendered"></div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
  export default {
    name: 'Page',
    components: {    },
    props: {
      slug: {
        type: String,
        required: true,
      },
    },
    data() {
      return {
        showMenu: false,
        request: {
          type: 'pages',
          slug: this.slug,
          showLoading: true,
        },
        site: this.$store.state.site,
      };
    },
    computed: {
      page() {
        return this.$store.getters.singleBySlug(this.request);
      },
    },
    methods: {
      getPage() {
        this.$store.dispatch('getSingleBySlug', this.request).then(() => {
          if (this.page) {
            this.$store.dispatch('updateDocTitle', {
              parts: [this.page.title.rendered, this.$store.state.site.name],
            });
          } else {
            this.$router.replace('/404');
          }
        });
      },
    },
    created() {
      this.getPage();
    },
  };
</script>
