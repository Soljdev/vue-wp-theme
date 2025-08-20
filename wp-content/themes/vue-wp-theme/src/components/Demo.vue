<template>
  <main id="wrapper">
    <!-- // demos -->
    <section v-if="demos.length">
      <article class="post dbg" v-for="demo in demos"
        :key="demo.id"
        :demo="demo">
        <ResponsiveImage
          v-if="demo.featured_media"
          class="post__featured-media"
          :media-id="demo.featured_media"
          :sizes="'(max-width: 680px) 40vw, 400px'"
        />
        <div class="post__content">
          <h2>
            <a 
              :href="demo.link"
              :title="demo.title.rendered"
              v-html="demo.title.rendered"
            ></a>
          </h2>
          <div v-html="demo.excerpt.rendered"></div>
        </div>
      </article>
    </section>
  </main>
</template>

<script>
import ResponsiveImage from './utility/ResponsiveImage.vue'

export default {
  name: 'Demo',
  components: {
    ResponsiveImage
  },
  props: {
    page: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      requestDemos: {
        type: 'demo',
        params: { 
          per_page: this.$store.state.site.posts_per_page,
          page: this.page
        }, 
        showLoading: true 
      },
      totalPages: 0
    }
  },
  computed: {
    demos() {
      return this.$store.getters.requestedItems(this.requestDemos)
    }
  },
  methods: {
    getDemos() {
      return this.$store.dispatch('getItems', this.requestDemos)
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.requestDemos)
    }
  },
  created() {
    console.log('Demo.vue // create()', this)
    this.getDemos().then(() => this.setTotalPages());
  }
}
</script>