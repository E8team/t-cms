<template>
    <div class="friendship-links">
        <CurrencyListPage title="友情连接列表" ref="list" queryName="links/type/1">
            <template scope="list">
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="name" label="链接名称"></el-table-column>
                    <el-table-column label="url">
                        <template scope="scope">
                            <a target="_blank" :href="scope.row.url">{{scope.row.url}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column property="order" label="排序"></el-table-column>
                    <el-table-column label="是否显示">
                        <template scope="scope">
                            <el-tag :type="scope.row.is_visible ? 'success' : 'gray'">{{scope.row.is_menu ? '显示' : '隐藏'}}</el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column property="linkman" label="联系人"></el-table-column>
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
                                <el-button size="mini" @click="$router.push({name: 'friendship-link-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
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
    export default {
        name: 'friendship_links',
        components: {
            CurrencyListPage
        },
        data () {
            return {
            }
        },
        methods: {
        },
        mounted () {
        }
    }
</script>

<style scoped lang="less">
</style>