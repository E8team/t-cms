<template>
    <div class="currency-list-page">
        <panel :title="title">
            <div slot="header">
                <el-input
                        v-model="keyword"
                        icon="search"
                        placeholder="请输入关键字">
                </el-input>
            </div>
            <div v-loading="loading" class="main">
                <slot :data="list"></slot>
            </div>
            <div slot="footer">
                <div class="footer">
                    <slot name="option"></slot>
                </div>
                <el-pagination
                        v-if="total > perPage"
                        class="page"
                        layout="prev, pager, next"
                        :total="total"
                        :current-page="currentPage"
                        :page-size="perPage"
                        @current-change="pageChange">
                </el-pagination>
            </div>
        </panel>
    </div>
</template>

<script>
    export default{
        name: 'currencyListPage',
        props: {
            title: String,
            queryName: String
        },
        data () {
            return {
                keyword: '',
                total: 0,
                perPage: 20,
                currentPage: 1,
                allowSortFields: [],
                delayTimer: null,
                list: [],
                loading: false
            }
        },
        mounted () {
            this.getList()
        },
        watch: {
            'keyword' () {
                if (this.delayTimer === null) {
                    this.delayTimer = setTimeout(() => {
                        this.getList(1, this.keyword)
                        clearTimeout(this.delayTimer)
                        this.delayTimer = null
                    }, 300)
                }
            }
        },
        methods: {
            getList (page = 1, keyword = '', sort) {
                this.loading = true
                this.$http.get(this.queryName, {
                    params: {
                        page,
                        q: keyword
                    }
                }).then(res => {
                    this.loading = false
                    this.list = res.data.data
                    this.total = res.data.meta.pagination.total
                    this.perPage = res.data.meta.pagination.per_page
                    this.allowSortFields = res.data.meta.allow_sort_fields
                }).catch(err => {
                    this.loading = false
                })
            },
            pageChange (currentPage) {
                this.getList(currentPage)
            }
        }
    }
</script>

<style scoped lang="less">
    .page {
        float: right;
        margin-right: 10px;
    }

    .footer {
        float: left;
    }

    .main {
        width: 100%;
    }
</style>
