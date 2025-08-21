import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import './output.css'

const app = createApp(App)
  .use(router)
  .use(store)

router.isReady().then(() => {
  const params = new URLSearchParams(window.location.search)
  if (!params.has('novue') && document.getElementById('vue-wordpress-app')) {
    // Параметр 'novue' отключает монтирование Vue приложения, что бы облегчить отладку и тестирование стандартного шаблона WordPress
    app.mount('#vue-wordpress-app');
  } else {
    console.warn('Vue app not mounted because "novue" query parameter is present or mount point is missing.');
  }
})
