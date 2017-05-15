<template>
    <div class="banners">
        <CurrencyListPage title="Banner list" ref="list" :queryName="queryName">
            <div slot="option">
                <el-button type="primary" @click="$router.push({name: 'banner-add'})" icon="plus">添加Banner</el-button>
            </div>
            <template scope="list">
                <el-tabs v-model="activeLink">
                    <el-tab-pane label="全部" name="all"></el-tab-pane>
                    <el-tab-pane v-for="item in linkTypes" :label="item.name" :key="item.id" :name="String(item.id)"></el-tab-pane>
                </el-tabs>
                <el-table border :data="list.data" style="width: 100%">
                    <el-table-column property="title" label="标题"></el-table-column>
                    <el-table-column label="url" width="200">
                        <template scope="scope">
                            <a target="_blank" :href="scope.row.url">{{scope.row.url}}</a>
                        </template>
                    </el-table-column>
                    <el-table-column property="order" label="排序"></el-table-column>
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
                                <el-button size="mini" @click="$router.push({name: 'banner-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
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
        name: 'banners',
        components: {
            CurrencyListPage
        },
        data () {
            return {
                linkTypes: [],
                activeLink: 'all'
            }
        },
        computed: {
            queryName () {
                return `banners/type/${this.activeLink}`;
            }
        },
        watch: {
            activeLink () {
                this.$refs['list'].refresh(this.queryName);
            }
        },
        methods: {
            del (id) {
                this.$confirm('你确定要删除该友情链接?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete(`banners/${id}`).then(res => {
                        this.$message('已删除');
                        this.$refs['list'].refresh()
                    })
                }).catch(() => {
                })
            }
        },
        mounted () {
            this.$http.get('types/banner').then(res => {
                this.linkTypes =  res.data.data;
            });
        }
    }
</script>

<style scoped lang="less">

</style>