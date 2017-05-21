<template>
    <div>
        <el-dialog @close="editTypeId = null, resetTypeForm()" title="管理分类" v-model="typeDialogVisible">
            <el-button type="primary" class="add-button" @click="openEditDialog()">添加分类</el-button>
            <el-table :data="types">
                <el-table-column property="name" label="分类名" width="200"></el-table-column>
                <el-table-column property="description" label="描述"></el-table-column>
                <el-table-column property="order" label="排序"></el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="160">
                    <template scope="scope">
                        <el-button-group>
                            <el-button size="mini" @click="openEditDialog(scope.row)" type="warning">编辑</el-button>
                            <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                        </el-button-group>
                    </template>
                </el-table-column>
            </el-table>

            <span slot="footer" class="dialog-footer">
                <el-button @click="typeDialogVisible = false">取 消</el-button>
                <el-button type="primary" @click="typeDialogVisible = false">完成</el-button>
            </span>
        </el-dialog>

        <el-dialog size="tiny" :title="title" v-model="editDialog">
            <el-form class="type_form" :model="currentType" label-width="85px">
                <el-form-item :error="errors.name" required label="分类名">
                    <el-input @change="errors.name = ''" placeholder="请设置分类名称" v-model="currentType.name"></el-input>
                </el-form-item>
                <el-form-item label="描述">
                    <el-input placeholder="请设置分类描述" type="textarea" :rows="4" v-model="currentType.description"></el-input>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input-number v-model="currentType.order"></el-input-number>
                </el-form-item>
            </el-form>
            <span slot="footer">
                <el-button @click="editDialog = false">取 消</el-button>
                <el-button type="primary" @click="confirmType()">{{typeEditStatus ? '确认编辑' : '确认添加'}}</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
export default{
    name: 'typeManagementDialog',
    props: {
        type: String,
        value: Boolean
    },
    data () {
        return {
            title: '',
            typeDialogVisible: false,
            editDialog: false,
            types: [],
            errors: [],
            editTypeId: null,
            currentType: {
                'name': null,
                'description': null,
                'order': null
            }
        }
    },
    mounted () {
        this.typeDialogVisible = this.value;
        this.refreshTypeList();
    },
    computed: {
        'typeEditStatus': {
            get: function () {
                return this.editTypeId != null;
            }
        }
    },
    watch: {
        typeDialogVisible (val, oldval) {
            if(val != oldval){
                this.$emit('input', val);
            }
        },
        'value' (val) {
            if (this.typeDialogVisible !== val) {
                this.typeDialogVisible = val
            }
        }
    },
    methods: {
        refreshTypeList () {
            this.$http.get(`types/${this.type}`).then(res => {
                this.types =  res.data.data;
                this.$emit('new_type', res.data.data);
            })
        },
        confirmType () {
            let method, url;
            this.typeEditStatus ? (method = 'put', url = `types/${this.editTypeId}`) : (method = 'post', url = 'types');
            this.currentType.class_name = this.type;
            delete this.currentType.id;
            this.$http[method](url, this.currentType).then(res => {
                this.$message({
                    message: `${this.typeEditStatus ? '编辑' : '添加'}成功`,
                    type: 'success'
                });
                this.editDialog = false;
                this.refreshTypeList();
            }).catch(err => {
                this.errors = err.response.data.errors;
            });
        },
        resetTypeForm () {
            this.currentType = {
                'name': null,
                'description': null,
                'order': null
            };
        },
        openEditDialog (type) {
            this.editDialog = true;
            if(type){
                this.title="编辑分类";
                this.editTypeId = type.id;
                this.currentType = type;
            }else{
                this.title="添加分类";
                this.editTypeId = null;
                this.resetTypeForm();
            }
        },
        del (id) {
            this.$confirm('你确定要删除该分类?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$http.delete(`types/${id}`).then(res => {
                    this.$message('已删除');
                    this.refreshTypeList();
                })
            }).catch(() => {
            })
        }
    }
}
</script>

<style scoped lang="less">
    .type_form{
        padding: 40px 40px 0 40px;
    }
    .add-button{
        margin-bottom: 15px;
    }
</style>