<template>
    <div class="permission">
        <panel :covered="false" :title="title">
            <el-form :model="permission" label-width="105px">
                <el-form-item required label="权限名">
                    <el-input placeholder="请设置权限名称" v-model="permission.name"></el-input>
                </el-form-item>
                <el-form-item label="display name">
                    <el-input placeholder="请设置 display name" v-model="permission.display_name"></el-input>
                </el-form-item>
                <el-form-item label="描述">
                    <el-input placeholder="请设置权限描述" type="textarea" :rows="4" v-model="permission.description"></el-input>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input-number v-model="permission.order"></el-input-number>
                </el-form-item>
                <el-form-item label="作为菜单">
                  <el-switch
                    v-model="permission.is_menu"
                    on-text="菜单"
                    off-text="普通">
                  </el-switch>
                </el-form-item>
                <el-form-item label="父级权限">
                     <el-select v-model="permission.parent_id" placeholder="请选择">
                       <el-option label="作为父级权限" :value="0"></el-option>
                      <el-option
                        :key="item.id"
                        v-for="item in topPermission"
                        :label="item.display_name"
                        :value="item.id">
                      </el-option>
                    </el-select>
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
                permission: {
                    'name': null,
                    'display_name': null,
                    'description': null,
                    'parent_id': 0,
                    'is_menu': false,
                    'icon': null,
                    'order': null
                },
                topPermission: []
            }
        },
        methods: {
            confirm () {
                let method, url;
                this.id ? (method = 'put', url = `permissions/${this.id}`) : (method = 'post', url = 'permissions');
                this.$http[method](url, {
                    ...this.permission
                }).then(res => {
                    this.$message({
                        message: `${this.title}成功`,
                        type: 'success'
                    });
                    this.$router.push({name: 'permissions'});
                });
            }
        },
        mounted () {
            this.$http.get('permissions/top').then(res => {
                this.topPermission = res.data.data
            })
            if (this.$route.name === 'permission-edit') {
                this.id = this.$route.params.id;
                this.$http.get(`permissions/${this.id}`).then(res => {
                    this.permission = res.data.data;
                });
                this.title = '编辑权限';
            }else{
                this.title = '添加权限';
            }
        }
    }
</script>