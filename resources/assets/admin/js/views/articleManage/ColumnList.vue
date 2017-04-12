<template>
  <div class="column_list">
    <div class="option">
        <el-button type="primary" @click="$router.push({name: 'column-add'})" icon="plus">添加栏目</el-button>
    </div>
    <panel title="栏目列表">
        <el-table v-loading="loading" border :data="columnList" style="width: 100%">
          <el-table-column label="栏目名">
            <template scope="scope">
              {{scope.row.indent_str + scope.row.cate_name}}
            </template>
          </el-table-column>
          <el-table-column property="cate_slug" label="slug"></el-table-column>
          <el-table-column property="description" label="栏目描述"></el-table-column>
          <el-table-column property="created_at" label="创建时间"></el-table-column>
          <el-table-column property="order" label="排序"></el-table-column>
          <el-table-column label="是否为导航">
            <template scope="scope">
                <el-tag :type="scope.row.is_nav ? 'success' : 'gray'">{{scope.row.is_nav ? '作为导航' : '普通栏目'}}</el-tag>
            </template>
          </el-table-column>
          <el-table-column
                  fixed="right"
                  label="操作"
                  width="160">
              <template scope="scope">
                  <el-button-group>
                      <el-button size="mini" @click="$router.push({name: 'column-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
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
      columnList: [],
      loading: false
    }
  },
  methods: {
    refresh () {
      this.loading = true;
      this.$http.get('categories/all', {
        params: {
          show: 'indent'
        }
      }).then(res => {
        this.loading = false;
        this.columnList = res.data;
      })
    },
    del (id) {
      this.$confirm('你确定要删除该栏目?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        this.$http.delete(`categories/${id}`).then(res => {
          this.$message('已删除');
          this.refresh();
        })
      }).catch(() => {
      })
    }
  },
  mounted () {
    this.refresh();
  }
}
</script>

<style scoped lang="less">
.column_list{
  .option{
     margin-bottom: 10px;
  }
}
</style>