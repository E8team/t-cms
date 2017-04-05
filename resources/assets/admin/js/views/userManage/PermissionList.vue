<template>
    <div class="permissions">
        <div class="option">
            <el-button type="primary" @click="$router.push({name: 'permission-add'})" icon="plus">添加权限</el-button>
        </div>
        <panel title="权限列表">
            <div class="body">
                <div class="parent_list">
                    <ul>
                        <li @click="currentId = item.id" v-for="item in topPermission" :class="{'active': currentId == item.id}">
                            <h3>{{item.display_name}}</h3>
                            <p>{{item.description}}</p>
                            <el-tag class="name" type="primary">{{item.name}}</el-tag>
                        </li>
                    </ul>
                </div>
                <div class="child" v-loading="loading">
                    <el-table border :data="childPermission" style="width: 100%">
                        <el-table-column property="name" label="权限"></el-table-column>
                        <el-table-column property="display_name" label="权限名称"></el-table-column>
                        <el-table-column property="description" label="描述"></el-table-column>
                        <el-table-column property="created_at" label="创建时间"></el-table-column>
                        <el-table-column label="状态">
                            <template scope="scope">
                                <el-tag :type="scope.row.is_menu ? 'success' : 'gray'">{{scope.row.is_menu ? '作为菜单' : '普通权限'}}</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column property="parent_id" label="父级id"></el-table-column>
                        <el-table-column
                                fixed="right"
                                label="操作"
                                width="160">
                            <template scope="scope">
                                <el-button-group>
                                    <el-button size="mini" @click="$router.push({name: 'permission-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
                                    <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                                </el-button-group>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </panel>
    </div>
</template>

<script>
    export default{
        components: {
        },
        data () {
            return {
                currentId: 0,
                topPermission: [],
                childPermission: [],
                loading: false
            }
        },
        methods: {
            del (id) {
                this.$confirm('你确定要删除该权限?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete(`permission/${id}`).then(res => {
                        this.$message('已删除');
                        this.$refs['list'].refresh()
                    })
                }).catch(() => {
                })
            }
        },
        watch: {
            'currentId' (id) {
                this.loading = true;
                this.$http.get(`permissions/${id}/children`).then(res => {
                    this.childPermission = res.data.data;
                    this.loading = false;
                }).catch(res => {
                    this.loading = false;
                });
            }
        },
        mounted () {
            this.$http.get('permissions/top').then(res => {
                this.topPermission = res.data.data
                this.currentId = this.topPermission[0].id
            })
        }
    }
</script>
<style lang="less" scoped>
    .permissions{
        .option{
            margin-bottom: 10px;
        }
        .body{
            display: flex;
            padding: 0;
            .parent_list{
                width: 280px;
                ul{ 
                    margin: 0;
                    padding: 0;
                    list-style: none;
                    border-right: 1px solid #f0f0f0;

                    li{
                        padding: 0 15px;
                        border-bottom: 1px solid #f0f0f0;
                        height: 60px;
                        position: relative;
                        &:hover, &.active{
                            background-color: #F0F0F0;
                            cursor: pointer;
                        }
                        &:last-child{
                            border: 0;
                        }
                        >h3{
                            color: #666;
                            font-size: 14px;
                            margin: 0;
                            line-height: 30px;
                        }
                        >p{
                            font-size: 12px;
                            color: #999;
                            margin: 0;
                            line-height: 25px;
                            overflow: hidden;
                            white-space: nowrap;
                            text-overflow: ellipsis;
                        }
                        >.name{
                            position: absolute;
                            right: 5px;
                            top: 5px;
                        }
                    }
                }
            }
            .child{
                flex-grow: 1;
                padding-left: 15px;
            }
        }
    }
</style>