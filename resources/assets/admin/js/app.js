require('./bootstrap');
import axios from 'axios'
import ElementUI from 'element-ui';
import NProgress from 'vue-nprogress'
import 'element-ui/lib/theme-default/index.css';
import App from './App.vue';
import router from './router'
Vue.use(ElementUI);
Vue.use(NProgress);
const nprogress = new NProgress({ parent: '.nprogress-container' })
import Panel from './components/Panel.vue'
Vue.component(Panel.name, Panel)
import * as filters from './filters.js'
Object.keys(filters).forEach(key => {
  Vue.filter(key, filters[key])
})
Vue.prototype.$diff = require('./utils/diff.js').default;

Vue.prototype.$http = axios.create({
    baseURL: `${window.t_meta.base_url}/api/admin/`,
    timeout: 5000,
    responseType: 'json',
    headers:{
        'X-CSRF-TOKEN': window.t_meta.csrfToken,
        'X-Requested-With': 'XMLHttpRequest'
    }
})
Vue.prototype.$axios = axios;
Vue.prototype.$http.interceptors.request.use((config) => {
    nprogress.start();
    return config;
}, (error) => {
    nprogress.done();
    return Promise.reject(error);
});
Vue.prototype.$http.interceptors.response.use((response) => {
    nprogress.done();
    return response;
}, (error) => {
    if(error.code === 'ECONNABORTED'){
        Vue.prototype.$message({
            showClose: true,
            message: "请求超时",
            type: 'error'
        })
    }else if(error.response.status !== 422){
        Vue.prototype.$message({
            showClose: true,
            message: error.response.data.message,
            type: 'error'
        })
        if(error.response.status === 401){
            router.push({name: 'login'});
        }
    }else{
        let errorsTemp = error.response.data.errors;
        for(let index in errorsTemp){
            errorsTemp[index] = errorsTemp[index].join(',')
        }
    }
    return Promise.reject(error);
});
Vue.prototype.$t_meta = window.t_meta;
new Vue({
    router,
    ...App,
    nprogress
}).$mount('#app')