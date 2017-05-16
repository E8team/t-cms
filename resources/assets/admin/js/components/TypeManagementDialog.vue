<template>
    <el-dialog @close="editTypeId = null, resetTypeForm()" title="编辑分类" v-model="typeDialogVisible">
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
                        <el-button size="mini" @click="edit(scope.row)" type="warning">编辑</el-button>
                        <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                    </el-button-group>
                </template>
            </el-table-column>
        </el-table>

        <el-form class="type_form" :model="currentType" label-width="85px">
            <el-form-item>
                <el-radio-group v-model="typeEditStatus">
                    <el-radio-button :label="false">添加</el-radio-button>
                    <el-radio-button :disabled="!typeEditStatus" :label="true">编辑</el-radio-button>
                </el-radio-group>
            </el-form-item>
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
        <span slot="footer" class="dialog-footer">
            <el-button @click="typeDialogVisible = false">取 消</el-button>
            <el-button type="primary" @click="confirmType()">{{typeEditStatus ? '确认编辑' : '确认添加'}}</el-button>
        </span>
    </el-dialog>
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
            typeDialogVisible: false,
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
        this.$http.get(`types/${this.type}`).then(res => {
            this.types =  res.data.data;
        })
    },
    computed: {
        'typeEditStatus': {
            get: function () {
                return this.editTypeId != null;
            },
            set: function (newValue) {
                this.editTypeId = null;
                this.resetTypeForm();
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
        confirmType () {
            let method, url;
            this.typeEditStatus ? (method = 'put', url = `types/${this.editTypeId}`) : (method = 'post', url = 'types');
            this.currentType.class_name = 'link';
            delete this.currentType.id;
            this.$http[method](url, this.currentType).then(res => {
                this.$message({
                    message: `${this.typeEditStatus ? '编辑' : '添加'}成功`,
                    type: 'success'
                });
                this.typeDialogVisible = false;
                this.$emit('new_type');
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
        edit (type) {
            this.editTypeId = type.id;
            this.currentType = type;
        },
        del (id) {
            this.$confirm('你确定要删除该分类?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$http.delete(`types/${id}`).then(res => {
                    this.$message('已删除');
                    this.$emit('new_type');
                })
            }).catch(() => {
            })
        }
    }
}
</script>

<style lang="less">
    .type_form{
        padding: 40px 40px 0 40px;
    }
</style>