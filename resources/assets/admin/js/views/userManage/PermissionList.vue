<template>
    <div class="users">
        <CurrencyListPage title="角色列表" queryName="roles">
            <div slot="option">
                <el-button type="primary" icon="plus">添加角色</el-button>
            </div>
            <template scope="list">
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="name" label="角色"></el-table-column>
                    <el-table-column property="display_name" label="角色名称"></el-table-column>
                    <el-table-column property="description" label="描述"></el-table-column>
                    <el-table-column
                            inline-template
                            :context="_self"
                            fixed="right"
                            label="操作"
                            width="160">
                        <el-button-group>
                            <el-button size="mini" type="warning">编辑</el-button>
                            <el-button size="mini" type="danger">删除</el-button>
                        </el-button-group>
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