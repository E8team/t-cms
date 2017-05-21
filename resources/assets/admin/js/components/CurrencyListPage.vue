<template>
    <div class="currency-list-page">
        <div v-if="$slots['option'] !== undefined" class="option_wrapper">
            <div class="option">
                <slot name="option"></slot>
            </div>
        </div>
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
                    <div class="page_num_box">
                        显示:
                        <el-select @change="change()" class="page_num" size="small" v-model="perPage">
                            <el-option label="5" :value="5"></el-option>
                            <el-option label="10" :value="10"></el-option>
                            <el-option label="20" :value="20"></el-option>
                            <el-option label="30" :value="30"></el-option>
                            <el-option label="40" :value="40"></el-option>
                        </el-select>
                        项结果
                    </div>
                </div>
                <el-pagination
                        class="page"
                        layout="prev, pager, next"
                        :total="total"
                        :current-page="currentPage"
                        :page-size="perPage"
                        @current-change="change">
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
            refresh () {
                this.$nextTick(() => {
                    this.getList(this.currentPage)
                })
            },
            getList (page = 1, keyword = '', sort) {
                if(this.queryName){
                    this.loading = true
                    this.$http.get(this.queryName, {
                        params: {
                            per_page: this.perPage,
                            page,
                            q: keyword
                        }
                    }).then(res => {
                        this.loading = false
                        this.list = res.data.data
                        this.total = res.data.meta.pagination.total
                        // this.perPage = res.data.meta.pagination.per_page
                        this.allowSortFields = res.data.meta.allow_sort_fields
                    }).catch(err => {
                        this.loading = false
                    })
                }
            },
            change (currentPage) {
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
    .page_num_box{
        font-size: 14px;
        color: #666;
        .page_num{
            margin: 0 5px;
            width: 70px;
        }
    }
    .footer {
        float: left;
    }
    .main {
        width: 100%;
    }
    .option_wrapper{
        overflow: hidden;
        margin-bottom: 10px;
        .option{
        }
    }
    .el-select {
        vertical-align: inherit;
    }
</style>
