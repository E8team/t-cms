<template>
    <div class="friendship-links">
        <CurrencyListPage title="友情连接列表" ref="list" :queryName="queryName">
            <div slot="option">
                <el-button type="primary" @click="$router.push({name: 'friendship-link-add'})" icon="plus">添加友情链接</el-button>
            </div>
            <template scope="list">
                <el-tabs v-model="activeLink">
                    <el-tab-pane v-for="item in linkTypes" :label="item.name" :key="item.id" :name="String(item.id)"></el-tab-pane>
                </el-tabs>
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
                linkTypes: [],
                activeLink: null
            }
        },
        computed: {
            queryName () {
                if(this.activeLink == null || this.activeLink == '0'){
                    return null;
                }else{
                    return `links/type/${this.activeLink}`;
                }
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
                    this.$http.delete(`links/${id}`).then(res => {
                        this.$message('已删除');
                        this.$refs['list'].refresh()
                    })
                }).catch(() => {
                })
            }
        },
        mounted () {
            this.$http.get('types/link').then(res => {
                this.linkTypes =  res.data.data;
                this.activeLink = String(this.linkTypes[0].id);
            });
        }
    }
</script>

<style scoped lang="less">
</style>