<template>
    <div class="home">
        <el-menu default-active="2" class="menu" theme="dark">
            <div class="user_box">
                <img src="https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=785610095,2402278722&fm=117&gp=0.jpg" alt="">
                <div class="info">
                    <span>admin</span>
                </div>
            </div>
            <el-submenu index="1">
                <template slot="title"><i class="el-icon-message"></i>用户管理</template>
                <el-menu-item index="1-2">用户列表</el-menu-item>
                <el-menu-item index="1-2">角色列表</el-menu-item>
                <el-menu-item index="1-1">权限列表</el-menu-item>
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
        mounted() {
        }
    }
</script>
