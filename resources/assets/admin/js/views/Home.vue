<template>
    <div class="home" :class="{'close': isClose}">
        <el-menu :unique-opened="true" :default-active="currentPath" :router="true" class="menu" theme="dark">
            <div class="user_box">
                <img :src="me.avatar_urls ? me.avatar_urls.md : ''" :alt="me.user_name">
                <div class="info">
                    <span>{{me.user_name}}</span>
                </div>
            </div>
            <el-submenu index="userManage">
                <template slot="title"><i class="el-icon-message"></i>用户管理</template>
                <el-menu-item index="/admin/home/users">用户列表</el-menu-item>
                <el-menu-item index="/admin/home/roles">角色列表</el-menu-item>
                <el-menu-item index="/admin/home/permissions">权限列表</el-menu-item>
            </el-submenu>
            <el-submenu index="setting">
                <template slot="title"><i class="el-icon-setting"></i>设置</template>
                <el-menu-item index="/admin/home/Configure">站点配置</el-menu-item>
                <el-menu-item index="/admin/home/roles">主题</el-menu-item>
            </el-submenu>
        </el-menu>
        <div class="content">
            <div class="header">
                <div @click="isClose = !isClose"  class="hamburger_close_box">
                    <span :class="{'hamburger': !isClose, 'close': isClose}"></span>
                </div>
            </div>
            <div class="content_body">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'name',
        data () {
            return{
                currentPath: '',
                me: {},
                isClose: false
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
