import { createApp } from 'vue'
import { vMaska } from "maska/vue"
import App from '../App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import store from './plugins/vuex'
import axios from 'axios'
import Toast from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const app = createApp(App)

app.use(router)
app.use(vuetify)
app.use(store)
app.use(Toast)
app.directive('maska', vMaska)

// AXIOS
axios.defaults.baseURL = 'http://localhost:8000/api/'
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`
app.config.globalProperties.$axios = axios

app.mount('#app')