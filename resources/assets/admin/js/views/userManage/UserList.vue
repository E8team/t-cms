<template>
    <div class="users">
        <CurrencyListPage title="用户列表" queryName="users">
            <div slot="option">
                <el-button type="primary" @click="$router.push({name: 'user-add'})" icon="plus">添加用户</el-button>
            </div>
            <template scope="list">
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="user_name" label="用户名"></el-table-column>
                    <el-table-column property="nick_name" label="昵称"></el-table-column>
                    <el-table-column property="email" label="email"></el-table-column>
                    <el-table-column property="created_at" label="创建时间"></el-table-column>
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
                                <el-button size="mini" type="danger">删除</el-button>
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
        mounted () {
        }
    }
</script>