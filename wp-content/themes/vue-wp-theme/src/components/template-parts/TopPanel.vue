<!-- @format -->

<template>
  <div class="top-panel py-3">
    <div class="top-panel-container container gap-8">
      <div class="logotype" v-if="logo" @click="$router.push('/')">
        <img class="logo max-h-6 md:max-h-10" :src="logo.source_url" :alt="site.name" />
      </div>
      <span v-else>{{ site.name }}</span>

      <div class="grow lg:hidden flex"></div>

      <!-- * top mode -->
      <nav class="top-panel--nav hidden lg:flex">
        <li
          v-for="item in menu"
          :key="item.id"
          class="top-nav-item"
          :class="{ 'group/item relative': item.children }"
        >
          <a
            :href="item.url"
            :target="item.target"
            :title="item.title"
            class="text-white hover:text-primary-500 flex items-center"
          >
            <span class="text-sm">{{ item.content }}</span>
            <svg
              v-if="item.children"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-4 ml-1"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m19.5 8.25-7.5 7.5-7.5-7.5"
              />
            </svg>
          </a>

          <ul
            v-if="item.children"
            class="shadow-md rounded-md overflow-hidden invisible absolute ml-[-1rem] left-[0] top-[100%] bg-white group/edit group-hover/item:visible"
          >
            <li v-for="subItem in item.children" :key="subItem.id" class="">
              <a
                :href="subItem.url"
                :target="subItem.target"
                :title="subItem.title"
                v-html="subItem.content"
                class="block text-nowrap py-2 px-4 text-black hover:bg-gray-200 transition-colors"
              ></a>
            </li>
          </ul>
        </li>
      </nav>

      <!-- * mobile mode -->
      <div class="block lg:hidden">
        <div
          class="p-2 text-primary-500 hover:text-primary-700 transition colors cursor-pointer"
          @click="toggleMenu()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
            />
          </svg>
        </div>
      </div>

      <transition name="swipe">
        <div class="mobile-menu-container z-20" v-if="this.showMenu">
          <div class="mobile-menu-container-inner p-6">
            <div
              class="inline-block p-2 fixed top-3 right-3 z-10 cursor-pointer text-primary-500 hover:text-white"
              @click="toggleMenu()"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18 18 6M6 6l12 12"
                />
              </svg>
            </div>

            <img
              v-if="logo"
              class="logo max-h-12 md:max-h-16"
              :src="logo.source_url"
              :alt="site.name"
            />
            <span v-else class="text-lg text-white">{{ site.name }}</span>

            <!-- Mobile Nav -->
            <nav class="flex flex-col gap-1 w-full">
              <li
                v-for="item in menu"
                :key="item.id"
                class="w-full rounded-[4px] overflow-hidden bg-black text-white list-none"
              >
                <a
                  :href="item.url"
                  :target="item.target"
                  :title="item.title"
                  class="px-4 py-2 transition-colors hover:bg-primary-700 flex items-center justify-between"
                >
                  <span>{{ item.content }}</span>
                  <svg
                    v-if="item.children"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="size-4 ml-1"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="m19.5 8.25-7.5 7.5-7.5-7.5"
                    />
                  </svg>
                </a>

                <ul v-if="item.children" class="m-0">
                  <li
                    v-for="(subItem, index) in item.children"
                    :key="subItem.id"
                    class=""
                  >
                    <a
                      :href="subItem.url"
                      :target="subItem.target"
                      :title="subItem.title"
                      class="block transition-colors text-nowrap px-4 :hovertext-black hover:bg-black transition-colors"
                    >
                      <span
                        v-html="subItem.content"
                        class="block py-2 px-2 border-t-[1px] border-slate-700"
                      ></span>
                    </a>
                  </li>
                </ul>
              </li>
            </nav>
          </div>
        </div>
      </transition>
      <transition name="fade">
        <div
          class="mobile-menu-overlay z-10"
          v-if="this.showMenu"
          @click="toggleMenu()"
        ></div>
      </transition>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'TopPanel',
    components: {
    },
    props: {
      showMenu: {
        type: Boolean,
        default: false,
      },
    },
    data() {
      return {
        site: this.$store.state.site,
        name: 'main',
      };
    },
    emits: ['toggleMenu'],
    computed: {
      logo() {
        if (this.site.logo) {
          return this.$store.getters.singleById({ type: 'media', id: this.site.logo });
        }
      },
      menu() {
        return this.$store.getters.menu({ name: this.name });
      },
    },
    methods: {
      toggleMenu() {
        this.$emit('toggleMenu');
      },
      setOverflow() {
        document.getElementsByTagName('html')[0].style.overflow = 'hidden';
      },
      unsetOverflow() {
        document.getElementsByTagName('html')[0].style.overflow = '';
      },
    },
    created() {
      console.log('TopPanel.vue > Created()');
    },
  };
</script>

<style>
  .top-panel {
    /* position: fixed; */
    position: relative;
    top: 0;
    left: 0;
    right: 0;
    background: #2d2d2bdb;
    z-index: 30;
    /* padding: 1rem 0; */
    font-size: 12px;
  }

  .top-panel-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  /* .top-panel-container a,
  .top-panel-container svg {
    display: block;
  } */

  .top-nav {
    flex-grow: 1;
    justify-content: center;
    align-items: center;
  }

  .site-branding {
    display: inline-block;
    padding: 1rem 0;
    cursor: pointer;
  }
  .site-branding > span {
    vertical-align: middle;
    font-size: 2.4rem;
    font-weight: bold;
  }

  .top-panel--nav {
    justify-content: flex-end;
    gap: 1.5rem;
    flex-grow: 1;
  }

  .top-nav {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .top-nav-item {
    display: flex;
    align-items: center;
    font-size: 12px;
  }

  .mobile-menu-container {
    position: fixed;
    right: 0;
    top: 0;
    bottom: 0;
    width: 90%;
    max-width: 380px;
    background: var(--tw-slate-800, #111);
    overflow: auto;
  }

  .mobile-menu-container-inner {
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    gap: 32px;
    align-items: center;
    justify-content: flex-start;
  }

  .mobile-menu-overlay {
    position: fixed;
    right: 0;
    top: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.6);
  }

  .swipe-enter-active {
    transition: 300ms all linear;
  }

  .swipe-leave-active {
    transition: 250ms all linear;
  }

  .swipe-enter-to,
  .swipe-leave {
    opacity: 1;
    transform: translate(0, 0);
  }

  .swipe-enter-from,
  .swipe-leave-to {
    opacity: 0;
    transform: translate(100%, 0);
  }

  .swipe-enter-active {
    transition: opacity 0.4s linear, transform 0.3s linear;
  }

  .swipe-leave-active {
    transition: opacity 0.2s linear, transform 0.3s linear;
  }
</style>
