<template>
    <div class="permissions">
        <panel title="权限管理">
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
                <div class="content">
                    <el-table border :data="childPermission" style="width: 100%">
                        <el-table-column property="name" label="角色"></el-table-column>
                        <el-table-column property="display_name" label="角色名称"></el-table-column>
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
                childPermission: []
            }
        },
        methods: {
            del (id) {
                this.$confirm('你确定要删除该角色?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$http.delete(`roles/${id}`).then(res => {
                        this.$message('已删除');
                        this.$refs['list'].refresh()
                    })
                }).catch(() => {
                })
            }
        },
        watch: {
            'this.currentId' () {
                this.$http.get(`permissions/${this.currentId}/children`).then(res => {
                    this.childPermission = res.data.data;
                });
            }
        },
        mounted () {
            this.$http.get('top_permissions').then(res => {
                this.topPermission = res.data.data
                this.currentId = this.topPermission[0].id
            })
        }
    }
</script>
<style lang="less" scoped>
    .permissions{
        .body{
            display: flex;
            padding: 0 30px;
            .parent_list{
                width: 280px;
                ul{ 
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
            .content{
                flex-grow: 1;
            }
        }
    }
</style>