<!-- @format -->

<template>
  <main>
    <article v-if="post">
      <header>
        <ResponsiveImage
          v-if="post.featured_media"
          :media-id="post.featured_media"
          :sizes="'(max-width: 1200px) 100vw, 1200px'"
        />
        <h1 v-html="post.title.rendered"></h1>
      </header>
      <div v-html="post.content.rendered"></div>
      <pre class="dbg">
        single = RADL::get( 'state.demo', get_the_ID() );
        {{ post }}
      </pre>
    </article>
  </main>
</template>

<script>
  import ResponsiveImage from './utility/ResponsiveImage.vue'

  export default {
    name: 'SingleDemo',
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
          type: 'demo',
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
