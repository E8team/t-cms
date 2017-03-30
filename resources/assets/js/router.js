import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
import Home from './views/Home.vue'
console.log(__dirname);
export default new Router({
    mode: 'history',
    base: __dirname,
    routes: [
        {
            path: '/home',
            name: 'home',
            component: Home
        },
        {
            path: '*',
            redirect: '/home'
        }
    ]
})

