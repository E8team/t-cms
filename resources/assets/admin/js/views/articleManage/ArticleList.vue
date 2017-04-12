<template>
  <div class="article_list">
    <div class="cate_tree_wrapper">
      <Tree v-model="activeIndex" :model="allCategories"></Tree>
    </div>
    <div class="main_list">
      <CurrencyListPage v-if="activeIndex" title="文章列表" ref="list" :queryName="queryName">
        <template scope="list">
          <el-table border :data="list.data" style="width: 100%">
            <el-table-column width="450px" property="title" label="标题"></el-table-column>
            <el-table-column property="user.nick_name" label="上传者"></el-table-column>
            <el-table-column width="80px" property="views_count" label="访问"></el-table-column>
            <el-table-column width="190px" property="published_at" label="发布时间"></el-table-column>
            <el-table-column
                  fixed="right"
                  label="操作"
                  width="160">
              <template scope="scope">
                  <el-button-group>
                      <el-button size="mini" @click="$router.push({name: 'article-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
                      <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                  </el-button-group>
              </template>
          </el-table-column>
          </el-table>
        </template>
      </CurrencyListPage>
    </div>
  </div>
</template>

<script>
import CurrencyListPage from '../../components/CurrencyListPage.vue'
import Tree from '../../components/tree/Tree.vue'
export default {
  name: 'articles',
  data () {
    return {
      props: {
        label: 'cate_name',
        children: 'children'
      },
      allCategories: [],
      activeIndex: null
    }
  },
  components: {
    CurrencyListPage, Tree
  },
  computed: {
    queryName () {
      return `categories/${this.activeIndex}/posts`
    }
  },
  watch: {
    activeIndex () {
      let listRef = this.$refs['list'];
      if(listRef){
        listRef.refresh(this.queryName);
      }
    }
  },
  mounted () {
    this.$http.get('categories/all').then(res => {
      this.allCategories = res.data
    })
  }
}
</script>

<style lang="less" scoped>
.article_list{
  .cate_tree_wrapper{
    position: fixed;
    top: 80px;
    bottom: 0;
    width: 190px;
    background-color: #fff;
  }
  .main_list{
    padding-left: 200px;
  }
}
</style>