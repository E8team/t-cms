<template>
    <div class="home">
        <div class="login_container">
            <h2>登录</h2>
            <el-form label-position="top" label-width="80px">
                <el-form-item label="用户名">
                    <el-input v-model="user_name" placeholder="请输入用户名"></el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="password" type="password" placeholder="请输入密码" @keyup.native.enter="login"></el-input>
                </el-form-item>
                <el-checkbox v-model="rember" class="remove_pwd_checkbox">记住密码</el-checkbox>
                <el-form-item>
                    <el-button @click="login" class="login_button" type="primary">登录</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'name',
        data () {
            return {
                user_name: '',
                password: '',
                rember: false
            }
        },
        methods: {
            login () {
                this.$http.post('admin/login', {
                    user_name: this.user_name,
                    password: this.password,
                    rember: this.rember
                }).then(res => {
                    this.$router.push({path: '/admin/home'})
                })
            }
        },
        mounted() {
        }
    }
</script>
