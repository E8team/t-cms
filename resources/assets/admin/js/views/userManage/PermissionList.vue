<template>
    <div class="permissions">
        <div class="parent_list">
            <ul>
                <li>用户管理</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default{
        components: {
        },
        data () {
            return {
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
        mounted () {
        }
    }
</script>
<style lang="less" scoped>
    .permissions{
        display: flex;
        .parent_list{
            width: 280px;
        }
    }
</style>