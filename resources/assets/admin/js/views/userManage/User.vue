<template>
    <div class="user">
        <panel :covered="false" :title="title">
            <el-form :model="user" label-width="100px">
                <el-form-item required label="用户名">
                    <el-input placeholder="请设置用户名" v-model="user.user_name"></el-input>
                </el-form-item>
                <el-form-item label="昵称">
                    <el-input placeholder="请设置用户昵称" v-model="user.nick_name"></el-input>
                </el-form-item>
                <el-form-item label="email">
                    <el-input placeholder="可用于登录和找回密码" v-model="user.email"></el-input>
                </el-form-item>
                <el-form-item label="头像">
                    <el-upload class="avatar-uploader"
                            action="https://jsonplaceholder.typicode.com/posts/"
                            :show-file-list="false" >
                        <!--<img class="avatar">-->
                        <i class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <el-form-item required label="密码">
                    <el-input placeholder="请设置登录密码" v-model="user.password"></el-input>
                </el-form-item>
                <el-form-item required label="确认密码">
                    <el-input placeholder="确认密码" v-model="user.rePassword"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button-group>
                        <el-button type="success" >确认</el-button>
                        <el-button @click="$router.back()">取消</el-button>
                    </el-button-group>
                </el-form-item>
            </el-form>
        </panel>
    </div>
</template>

<script>
    export default{
        data () {
            return {
                title: '',
                userId: null,
                user: {
                    'user_name': '',
                    'nick_name': '',
                    'email': '',
                    'avatar': '',
                    'password': '',
                    'rePassword': ''
                }
            }
        },
        mounted () {
            if (this.$route.name === 'user-edit') {
                this.userId = this.$route.params.id
                this.title = '编辑用户'
            }else{
                this.title = '添加用户'
            }
        }
    }
</script>

<style lang="less">
    .user{
        .avatar-uploader>.el-upload {
            border-radius: 6px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
        }
        .avatar-uploader>.el-upload:hover {
            border-color: #20a0ff;
            color: #20a0ff;
        }
        .avatar-uploader-icon {
            font-size: 28px;
            color: #8c939d;
            width: 148px;
            height: 148px;
            line-height: 148px;
            text-align: center;
        }
        .avatar {
            width: 148px;
            height: 148px;
            display: block;
        }
    }
</style>