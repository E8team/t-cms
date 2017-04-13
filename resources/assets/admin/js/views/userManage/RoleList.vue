<template>
    <div class="roles">
        <CurrencyListPage title="角色列表" queryName="roles">
            <div slot="option">
                <el-button type="primary" @click="$router.push({name: 'role-add'})" icon="plus">添加角色</el-button>
            </div>
            <template scope="list">
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="name" label="角色"></el-table-column>
                    <el-table-column property="display_name" label="角色名称"></el-table-column>
                    <el-table-column property="description" label="描述"></el-table-column>
                    <el-table-column width="120px" label="创建时间">
                        <template scope="scope">
                        <el-tooltip :content="scope.row.created_at" placement="left-start">
                            <span>{{scope.row.created_at | onlyDate}}</span>
                        </el-tooltip>
                        </template>
                    </el-table-column>
                    <el-table-column
                            fixed="right"
                            label="操作"
                            width="160">
                        <template scope="scope">
                            <el-button-group>
                                <el-button size="mini" @click="$router.push({name: 'role-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
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
        data () {
            return {
            }
        },
        mounted () {

        }
    }
</script>