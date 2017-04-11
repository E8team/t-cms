<template>
  <div class="column">
    <panel title="栏目列表">
        <el-table border :data="columnList" style="width: 100%">
          <el-table-column label="栏目名">
            <template scope="scope">
              {{scope.row.indent_str + scope.row.cate_name}}
            </template>
          </el-table-column>
          <el-table-column property="cate_slug" label="slug"></el-table-column>
          <el-table-column property="description" label="栏目描述"></el-table-column>
          <el-table-column property="created_at" label="创建时间"></el-table-column>
          <el-table-column property="order" label="排序"></el-table-column>
          <el-table-column
                  fixed="right"
                  label="操作"
                  width="160">
              <template scope="scope">
                  <el-button-group>
                      <el-button size="mini" @click="$router.push({name: 'user-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
                      <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                  </el-button-group>
              </template>
          </el-table-column>
        </el-table>
    </panel>
  </div>
</template>

<script>
export default {
  components: {
  },
  data () {
    return {
      columnList: []
    }
  },
  mounted () {
    this.$http.get('categories/all', {
      params: {
        show: 'indent'
      }
    }).then(res => {
      this.columnList = res.data;
    })
  }
}
</script>

<style scoped lang="less">

</style>