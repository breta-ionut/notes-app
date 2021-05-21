import './styles/app.css';

import 'core-js'
import 'regenerator-runtime/runtime'

import {createApp} from 'vue'
import VueAxios from 'vue-axios'

import axios from './js/axios.js'
import App from './js/pages/App.vue'
import router from './js/router.js'
import store from './js/store/index.js'

createApp(App)
    .use(router)
    .use(VueAxios, axios)
    .use(store)
    .mount('#app')
