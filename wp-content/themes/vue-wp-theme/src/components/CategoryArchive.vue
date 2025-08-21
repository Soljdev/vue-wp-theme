<template>
  <main id="wrapper">
    <div class="container">
			<header>
			<h1>{{ title }}</h1>
			</header>
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
    </div>
  </main>
</template>

<script>

export default {
  name: 'CategoryArchive',
  components: {  },
  props: {
    page: {
      type: Number,
      required: true
    },
    slug: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      postsRequest: {
        type: 'posts',
        params: {
          per_page: this.$store.state.site.posts_per_page,
          page: this.page,
          categories: null
        },
        showLoading: true
      },
      categoryRequest: {
        type: 'categories',
        slug: this.slug
      },
      totalPages: 0
    }
  },
  computed: {
    category() {
      return this.$store.getters.singleBySlug(this.categoryRequest)
    },
    posts() {
      if (this.category) {
        return this.$store.getters.requestedItems(this.postsRequest)
      }
      return [];
    },
    title() {
      return `CategoryArchive for ${this.category ? this.category.name : ''}`
    }
  },
  methods: {
    getCategory() {
      return this.$store.dispatch('getSingleBySlug', this.categoryRequest).then(() => {
        this.setPostsRequestParams()
        this.$store.dispatch('updateDocTitle', { parts: [ this.category.name, this.$store.state.site.name ] })
      })
    },
    getPosts() {
      return this.$store.dispatch('getItems', this.postsRequest)
    },
    setPostsRequestParams() {
      this.postsRequest.params.categories = this.category.id
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.postsRequest)
    }
  },
  created() {
    this.getCategory().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>