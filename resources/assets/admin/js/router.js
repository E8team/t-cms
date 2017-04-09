import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)
import Admin from './views/Admin.vue'
import Home from './views/Home.vue'
import Login from './views/Login.vue'
export default new Router({
    mode: 'history',
    base: __dirname,
    routes: [
        {
            path: '/admin',
            component: Admin,
            children: [
                {
                    path: '/',
                    redirect: '/admin/home'
                },
                {
                    path: 'home',
                    name: 'home',
                    component: Home,
                    children: [
                        {
                            path: 'users',
                            name: 'users',
                            component: require('./views/userManage/UserList.vue')
                        },
                        {
                            path: 'user-add',
                            name: 'user-add',
                            component: require('./views/userManage/User.vue')
                        },
                        {
                            path: 'user-edit/:id',
                            name: 'user-edit',
                            component: require('./views/userManage/User.vue')
                        },
                        {
                            path: 'roles',
                            name: 'roles',
                            component: require('./views/userManage/RoleList.vue')
                        },
                        {
                            path: 'role-add',
                            name: 'role-add',
                            component: require('./views/userManage/Role.vue')
                        },
                        {
                            path: 'role-edit/:id',
                            name: 'role-edit',
                            component: require('./views/userManage/Role.vue')
                        },
                        {
                            path: 'permissions',
                            name: 'permissions',
                            component: require('./views/userManage/PermissionList.vue')
                        },
                        {
                            path: 'permission-add',
                            name: 'permission-add',
                            component: require('./views/userManage/Permission.vue')
                        },
                        {
                            path: 'permission-edit/:id',
                            name: 'permission-edit',
                            component: require('./views/userManage/Permission.vue')
                        },
                        {
                            path: 'articles',
                            name: 'articles',
                            component: require('./views/articleManage/ArticleList.vue')
                        },
                        {
                            path: 'article-add',
                            name: 'article-add',
                            component: require('./views/articleManage/Article.vue')
                        },
                        {
                            path: 'article-edit/:id',
                            name: 'article-edit',
                            component: require('./views/articleManage/Article.vue')
                        },
                        {
                            path: 'configure',
                            name: 'configure',
                            component: require('./views/setting/Configure.vue')
                        }
                    ]
                },
                {
                    path: 'login',
                    name: 'login',
                    component: Login
                }
            ]
        },
        {
            path: '*',
            redirect: '/admin/home'
        },
    ]
})

