<template>
    <div class="user">
        <panel :covered="false" :title="title">
            <el-form :model="role" label-width="105px">
                <el-form-item :error="errors.name" required label="角色名">
                    <el-input @change="errors.name = ''" placeholder="请设置角色名称" v-model="role.name"></el-input>
                </el-form-item>
                <el-form-item label="display name">
                    <el-input placeholder="请设置 display name" v-model="role.display_name"></el-input>
                </el-form-item>
                <el-form-item label="描述">
                    <el-input placeholder="请设置角色描述" type="textarea" :rows="4" v-model="role.description"></el-input>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input-number v-model="role.order"></el-input-number>
                </el-form-item>
                <el-form-item label="选择权限">
                    <div class="permission">
                        <el-checkbox-group v-model="role.permission_ids">
                            <div v-for="permissions in allPermission">
                                <header class="title">{{permissions.display_name}}</header>
                                <el-checkbox v-for="permission in permissions.children" :key="permission.id" :label="permission.id">{{permission.display_name}}</el-checkbox>
                            </div>
                        </el-checkbox-group>
                    </div>
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
                errors: [],
                title: '',
                id: null,
                role: {
                    'name': null,
                    'display_name': null,
                    'description': null,
                    'order': null,
                    'permission_ids': []
                },
                allPermission: []
            }
        },
        methods: {
            confirm () {
                let method, url;
                this.id ? (method = 'put', url = `roles/${this.id}`) : (method = 'post', url = 'roles');
                this.$http[method](url, {
                    ...this.role
                }).then(res => {
                    this.$message({
                        message: `${this.title}成功`,
                        type: 'success'
                    });
                    this.$router.push({name: 'roles'});
                }).catch(err => {
                    this.errors = err.response.data.errors;
                });
            }
        },
        mounted () {
            this.$http.get('permissions/all').then(res => {
                this.allPermission = res.data;
            })
            if (this.$route.name === 'role-edit') {
                this.id = this.$route.params.id;
                this.$http.get(`roles/${this.id}`).then(res => {
                    res.data.data.permission_ids = res.data.meta.permission_ids;
                    this.role = res.data.data;
                })
                this.title = '编辑角色';
            }else{
                this.title = '添加角色';
            }
        }
    }
</script>

<style scoped lang="less">
    .permission{
        padding: 0 10px;
        .title{
            color: #999;
        }
    }
</style>