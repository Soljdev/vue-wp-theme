<!-- @format -->

<template>
  <main id="wrapper">
    <article class="container" v-if="post">
      <h1 v-html="post.title.rendered"></h1>
      <div v-html="post.content.rendered"></div>
      <pre class="dbg">
        single.vue
        getPost()
        {{ post }}
      </pre>
    </article>
  </main>
</template>

<script>
  import ResponsiveImage from './utility/ResponsiveImage.vue'

  export default {
    name: 'Single',
    components: {
      ResponsiveImage
    },
    props: {
      slug: {
        type: String,
        required: false,
      },
    },
    data() {
      return {
        request: {
          type: 'posts',
          slug: this.slug,
          showLoading: true,
        },
      };
    },
    computed: {
      post() {
        return this.$store.getters.singleBySlug(this.request);
      },
    },
    methods: {
      getPost() {
        this.$store.dispatch('getSingleBySlug', this.request).then(() => {
          this.$store.dispatch('updateDocTitle', {
            parts: [this.post.title.rendered, this.$store.state.site.name],
          });
        });
      },
    },
    created() {
      this.getPost();
    },
  };
</script>
