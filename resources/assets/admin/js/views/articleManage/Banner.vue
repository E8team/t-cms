<template>
    <div class="banner">
        <panel :covered="false" :title="title">
            <el-form :model="friendshipLink" label-width="85px">
                <el-form-item :error="errors.url" required label="URL">
                    <el-input @change="errors.url = ''" placeholder="请设置友情链接URL" v-model="friendshipLink.url"></el-input>
                npm</el-form-item>
            </el-form>
        </panel>
    </div>
</template>
<script>
export default{
    data () {
        return {}
    },
    mounted () {
    }
}
</script>

<style lang="less">
    .type_form{
        padding: 40px 40px 0 40px;
    }
</style>



