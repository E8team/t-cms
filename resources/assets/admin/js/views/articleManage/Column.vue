<template>
  <div class="column">
    <panel :covered="false" :title="title">
        <el-form :model="user" label-width="85px">
            <el-form-item required label="用户名">
                <el-input placeholder="请设置用户名" v-model="user.user_name"></el-input>
            </el-form-item>
        </el-form>
    </panel>
  </div>
</template>

<script>
export default{
  data () {
    return {
    }
  },
  mounted () {
    if (this.$route.name === 'column-edit') {
        this.id = this.$route.params.id;
        this.$http.get(`users/${this.id}`).then(res => {
            this.user = res.data.data;
        });
        this.title = '编辑用户';
      }else{
          this.title = '添加用户';
      }
  }
}
</script>

<style scoped lang="less">
</style>