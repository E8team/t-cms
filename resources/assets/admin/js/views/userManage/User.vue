<template>
    <div class="user">
        <panel :covered="false" :title="title">
            <el-form :model="user" label-width="85px">
                <el-form-item required label="用户名">
                    <el-input placeholder="请设置用户名" v-model="user.user_name"></el-input>
                </el-form-item>
                <el-form-item label="昵称">
                    <el-input placeholder="请设置用户昵称" v-model="user.nick_name"></el-input>
                </el-form-item>
                <el-form-item required label="email">
                    <el-input placeholder="可用于登录和找回密码" v-model="user.email"></el-input>
                </el-form-item>
                <el-form-item label="头像">
                    <el-upload class="avatar-uploader"
                            accept="image/jpeg,image/png"
                            :action="`${$t_meta.base_url}/ajax_upload_picture`"
                            :with-credentials="true"
                            :headers="{'X-CSRF-TOKEN': $t_meta.csrfToken}"
                            :on-success="handleAvatarSuccess"
                            :before-upload="beforeAvatarUpload"
                            :show-file-list="false" >
                        <img v-if="user.avatar_urls.xs" :src="user.avatar_urls.xs" class="avatar" />
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <el-form-item required label="选择角色">
                    <el-checkbox-group v-model="user.role_ids">
                        <el-checkbox v-for="item in allRoles" :label="item.id" :key="item.id">{{item.display_name}}</el-checkbox>
                    </el-checkbox-group>
                </el-form-item>
                <el-form-item required label="密码">
                    <el-input placeholder="请设置登录密码" v-model="user.password"></el-input>
                </el-form-item>
                <el-form-item required label="确认密码">
                    <el-input placeholder="确认密码" v-model="user.rePassword"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button-group>
                        <el-button type="success" @click="confirm">确认</el-button>
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
                id: null,
                allRoles: [],
                user: {
                    'user_name': null,
                    'nick_name': null,
                    'email': null,
                    'avatar': null,
                    'avatar_urls': {},
                    'password': null,
                    'rePassword': null,
                    'role_ids': []
                }
            }
        },
        methods: {
            handleAvatarSuccess (res, file) {
                this.user.avatar_urls.xs = URL.createObjectURL(file.raw);
                this.$forceUpdate();
                this.user.avatar = res.picture;
            },
            beforeAvatarUpload(file) {
                const isPIC = file.type === 'image/jpeg' || file.type === 'image/png';
                if (!isPIC) {
                    this.$message.error('上传头像图片只能是 JPG 或 PNG 格式!');
                }
                return isPIC;
            },
            confirm () {
                let method, url;
                this.id ? (method = 'put', url = `users/${this.id}`) : (method = 'post', url = 'users');
                this.$http[method](url, {
                    ...this.user
                }).then(res => {
                    this.$message({
                        message: `${this.title}成功`,
                        type: 'success'
                    });
                    this.$router.push({name: 'users'});
                });
            }
        },
        mounted () {
            this.$http.get('roles/all').then(res => {
                this.allRoles = res.data.data;
            });
            if (this.$route.name === 'user-edit') {
                this.id = this.$route.params.id;
                this.$http.get(`users/${this.id}`).then(res => {
                    this.user = res.data.data;
                });
                this.title = '编辑用户';
            }else{
                this.title = '添加用户';
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