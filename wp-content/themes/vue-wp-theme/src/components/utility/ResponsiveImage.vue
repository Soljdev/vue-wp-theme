<!-- @format -->

<template>
  <div class="responsive-image" :style="aspectRatioAttribute">
    <!-- <transition name="fade" :duration="1000"> -->
    <a v-if="link && image" :href="link">
      <img v-bind="imageAttributes" />
    </a>
    <div v-else-if="image">
      <img
        :src="this.image?.source_url"
        :srcset="this.srcset"
        :sizes="this.sizes"
        :alt="this.title || this.image?.alt_text"
        :title="this.title || this.image?.title.rendered"
        :style="`object-fit: ${this.imageSize}`"
      />
    </div>
    <!-- </transition> -->
  </div>
</template>

<script>
  export default {
    name: 'ResponsiveImage',
    props: {
      mediaId: {
        type: Number,
        required: true,
      },
      link: {
        type: [String, Boolean],
        required: false,
      },
      title: {
        type: String,
        required: false,
      },
      sizes: {
        type: String,
        required: false,
      },
      proportions: {
        type: Boolean,
        default: true,
      },
      imageSize: {
        type: String,
        required: false,
        default: 'cover',
      },
    },
    data() {
      return {
        request: {
          type: 'media',
          id: this.mediaId,
          batch: true,
        },
      };
    },
    computed: {
      imageRatio() {
        if (this.image) {
          return this.image.media_details.width + '/' + this.image.media_details.height;
        }
      },
      image() {
        return this.$store.getters.singleById(this.request);
      },
      srcset() {
        if (this.image) {
          let sizes = this.image.media_details.sizes;
          return Object.keys(sizes)
            .reduce((srcset, size) => {
              srcset.push(`${sizes[size].source_url} ${sizes[size].width}w`);
              return srcset;
            }, [])
            .join(', ');
        }
      },
      imageAttributes() {
        if (this.image) {
          return {
            src: this.image?.source_url,
            srcset: this.srcset,
            sizes: this.sizes,
            alt: this.title || this.image?.alt_text,
            title: this.title || this.image?.title.rendered,
            style: `object-fit: ${this.imageSize};`,
            // class: 'aspect-[' + this.imageRatio + ']',
          };
        }
      },
      aspectRatioAttribute() {
        if (this.proportions) {
          return 'aspect-ratio: ' + this.imageRatio;
        }
      },
    },
    methods: {
      getMedia() {
        if (this.mediaId) {
          this.$store.dispatch('getSingleById', this.request);
        }
      },
    },
    created() {
      console.log('ResponsiveImage.vue => created()', this.mediaId, this);
      this.getMedia();
    },
  };
</script>

<style>
  .responsive-image {
    position: relative;
    overflow: hidden;
    width: 100%;
    /* border-radius: 12px; */
    /* height: max-content; */
  }

  .responsive-image.--fill a,
  .responsive-image.--fill div {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
  }

  .responsive-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  .responsive-image.--fill img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  .responsive-image a {
    transform: scale(0.97) rotate(0);
    transform-origin: center;
    transition: all 280ms ease;
  }

  .responsive-image a:hover {
    transform: scale(1) rotate(0);
  }
</style>
