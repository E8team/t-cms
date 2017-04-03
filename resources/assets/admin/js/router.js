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

