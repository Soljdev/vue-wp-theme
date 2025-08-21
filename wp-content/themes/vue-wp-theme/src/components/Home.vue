<template>
  <main id="wrapper">
    <div class="container">
      <pre class="dbg">
        home.vue
        site: this.$store.state.site
        {{ site }}
      </pre>
      <!-- // posts -->
      this.getPosts()
      <section class="mb-8" v-if="posts.length">
        <article class="post dbg" v-for="post in posts"
          :key="post.id"
          :post="post"
        >
          <h2>
            <a 
              :href="post.link"
              :title="post.title.rendered"
              v-html="post.title.rendered"
            ></a>
          </h2>
          <div v-html="post.excerpt.rendered"></div>
        </article>
      </section>
      <!-- // demos -->
      this.getDemos()
      <section class="mb-8" v-if="demos.length">
        <article class="post dbg" v-for="demo in demos"
          :key="demo.id"
          :demo="demo"
        >
          <h2>
            <a 
              :href="demo.link"
              :title="demo.title.rendered"
              v-html="demo.title.rendered"
            ></a>
          </h2>
          <div v-html="demo.excerpt.rendered"></div>
        </article>
      </section>
    </div>
  </main>
</template>

<script>
import ResponsiveImage from './utility/ResponsiveImage.vue'

export default {
  name: 'Home',
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
      site: this.$store.state.site,
      requestPosts: {
        type: 'posts',
        params: { 
          per_page: this.$store.state.site.posts_per_page,
          page: this.page
        }, 
        showLoading: true 
      },
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
    posts() {
      return this.$store.getters.requestedItems(this.requestPosts)
    },
    demos() {
      return this.$store.getters.requestedItems(this.requestDemos)
    }
  },
  methods: {
    getPosts() {
      return this.$store.dispatch('getItems', this.requestPosts)
    },
    getDemos() {
      return this.$store.dispatch('getItems', this.requestDemos)
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.requestPosts)
    }
  },
  created() {
    console.log('Home.vue // create()', this)
    this.getPosts().then(() => this.setTotalPages());
    this.getDemos().then();
  }
}
</script>