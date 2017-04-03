<template>
    <div class="user">
        <panel :covered="false" :title="title">
            <el-form :model="role" label-width="105px">
                <el-form-item required label="角色名">
                    <el-input placeholder="请设置角色名称" v-model="role.name"></el-input>
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
                role: {
                    'name': null,
                    'display_name': null,
                    'description': null,
                    'order': null,
                }
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
                });
            }
        },
        mounted () {
            if (this.$route.name === 'role-edit') {
                this.id = this.$route.params.id;
                this.$http.get(`roles/${this.id}`).then(res => {
                    this.role = res.data.data;
                });
                this.title = '编辑角色';
            }else{
                this.title = '添加角色';
            }
        }
    }
</script>