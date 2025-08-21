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
  if (!params.has('novue')) {
    app.mount('#vue-wordpress-app')
  }
})
