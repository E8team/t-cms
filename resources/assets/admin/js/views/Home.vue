<template>
    <div class="home">
        <el-menu :unique-opened="true" :default-active="currentPath" :router="true" class="menu" theme="dark">
            <div class="user_box">
                <img :src="me.avatar_urls ? me.avatar_urls.md : ''" :alt="me.user_name">
                <div class="info">
                    <span>{{me.user_name}}</span>
                </div>
            </div>
            <el-submenu index="userManage">
                <template slot="title"><i class="el-icon-message"></i>用户管理</template>
                <el-menu-item index="/admin/home/user-list">用户列表</el-menu-item>
                <el-menu-item index="/admin/home/role-list">角色列表</el-menu-item>
                <el-menu-item index="/admin/home/permission-list">权限列表</el-menu-item>
            </el-submenu>
        </el-menu>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'name',
        data () {
            return{
                currentPath: '',
                me: {}
            }
        },
        mounted() {
            this.currentPath = this.$route.path
            this.$http.get('me').then(res => {
                this.me = res.data.data
            })
        }
    }
</script>
