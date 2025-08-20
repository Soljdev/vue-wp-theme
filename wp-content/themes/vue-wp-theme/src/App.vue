<!-- @format -->

<template>
  <div @click="handleClicks" style="--primary-color: #f00">
    <TopPanel
      name="main"
      @toggle-menu="toggleMenu"
      :showMenu="this.showMenu"
    />
    <transition
      name="fade"
      mode="out-in"
      @after-leave="updateScroll"
      @before-leave="offMenu"
    >
      <router-view :key="$route.path" v-slot="slotProps">
        <component :is="slotProps.Component" />
      </router-view>
    </transition>

    <transition name="fade">
      <SiteLoading v-if="loading" />
    </transition>
  </div>
</template>

<script>
  import SiteLoading from '@/components/utility/SiteLoading';
  import TopPanel from './components/template-parts/TopPanel.vue';

  export default {
    components: {
      SiteLoading,
      TopPanel
    },
    data() {
      return {
        site: this.$store.state.site,
        showMenu: false,
        offMenu: undefined,
      };
    },
    computed: {
      loading() {
        return this.$store.state.site.loading;
      },
    },
    methods: {
      getLinkEl(el) {
        while (el.parentNode) {
          if (el.tagName === 'A') return el;
          el = el.parentNode;
        }
      },
      handleClicks(e) {
        const a = this.getLinkEl(e.target);
        if (a && a.href.includes(this.site.url)) {
          const { altKey, ctrlKey, metaKey, shiftKey, button, defaultPrevented } = e;
          // don't handle if has class 'no-router'
          if (a.className.includes('no-router')) return;
          // don't handle with control keys
          if (metaKey || altKey || ctrlKey || shiftKey) return;
          // don't handle when preventDefault called
          if (defaultPrevented) return;
          // don't handle right clicks
          if (button !== undefined && button !== 0) return;
          // don't handle if `target="_blank"`
          if (a.target && a.target.includes('_blank')) return;
          // don't handle same page links
          let currentURL = new URL(a.href, window.location.href);
          if (currentURL && currentURL.pathname === window.location.pathname) {
            // if same page link has same hash prevent default reload
            if (currentURL.hash === window.location.hash) e.preventDefault();
            return;
          }
          // Prevent default and push to vue-router
          e.preventDefault();
          let path = a.href.replace(this.site.url, '');
          this.$router.push(path);
        }
      },

      updateScroll() {
        window.scroll(0, 0);
        document.getElementsByTagName('html')[0].style.overflow = '';
      },
    },
    watch: {},
    created() {
      console.log('App.vue > created()', this);
    },
    mounted() {},
    beforeDestroy() {},
  };
</script>

<style>
  /* ------------------------------------------
 * Vue transition classes
 * ------------------------------------------ */
  .fade-enter-active {
    transition: opacity 0.4s cubic-bezier(0.4, 0, 0, 1);
  }

  .fade-leave-active {
    transition: opacity 0.2s cubic-bezier(0.4, 0, 0, 1);
  }

  .fade-enter-to,
  .fade-leave-from {
    opacity: 1;
  }

  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
</style>
