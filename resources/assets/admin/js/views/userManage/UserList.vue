<template>
    <div class="users">
        <CurrencyListPage title="用户列表" ref="list" queryName="users">
            <div slot="option">
                <el-button type="primary" @click="$router.push({name: 'user-add'})" icon="plus">添加用户</el-button>
            </div>
            <template scope="list">
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="user_name" label="用户名"></el-table-column>
                    <el-table-column property="nick_name" label="昵称"></el-table-column>
                    <el-table-column property="email" label="email"></el-table-column>
                    <el-table-column width="120px" label="创建时间">
                        <template scope="scope">
                        <el-tooltip :content="scope.row.created_at" placement="left-start">
                            <span>{{scope.row.created_at | onlyDate}}</span>
                        </el-tooltip>
                        </template>
                    </el-table-column>
                    <el-table-column label="状态">
                        <template scope="scope">
                            <el-tag :type="scope.row.is_lock ? 'danger' : 'success'">{{scope.row.is_lock ? '锁定' : '正常'}}</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                            width="160">
                        <template scope="scope">
                            <el-button-group>
                                <el-button size="mini" @click="$router.push({name: 'user-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
                                <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                            </el-button-group>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </CurrencyListPage>
    </div>
</template>

<script>
    import CurrencyListPage from '../../components/CurrencyListPage.vue'
    export default{
        components: {
            CurrencyListPage
        },
        data () {
            return {
            }
        },
        methods: {
            del (id) {
                this.$confirm('你确定要删除该用户?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete(`users/${id}`).then(res => {
                        this.$message('已删除');
                        this.$refs['list'].refresh()
                    })
                }).catch(() => {
                })
            }
        },
        mounted () {
        }
    }
</script>