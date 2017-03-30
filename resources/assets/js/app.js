require('./bootstrap');
import axios from 'axios'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-default/index.css';
import App from './App.vue';
import router from './router'
Vue.use(ElementUI);
Vue.prototype.$http = axios.create({
    baseURL: '/api/',
})
Vue.prototype.$http.defaults.headers.common = {
    // 'X-CSRF-TOKEN': window.t_meta.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};
new Vue(Vue.util.extend({ router }, App)).$mount('#app');