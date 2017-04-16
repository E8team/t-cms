<template>
  <div class="article_list">
    <div class="cate_tree_wrapper">
      <header>
        <h3>文章栏目</h3>
        <el-button @click="$router.push({name: 'column-add'})" class="add_btn" icon="plus" size="small"></el-button>
      </header>
      <Tree v-model="activeIndex" :model="allCategories"></Tree>
    </div>
    <div class="main_list">
      <CurrencyListPage title="文章列表" ref="list" :queryName="queryName">
        <template scope="list">
          <el-table border :data="list.data" style="width: 100%">
            <el-table-column width="450px" property="title" label="标题"></el-table-column>
            <el-table-column property="user.nick_name" label="发布者"></el-table-column>
            <el-table-column width="80px" property="views_count" label="访问"></el-table-column>
            <el-table-column width="120px" label="发布时间">
              <template scope="scope">
                <el-tooltip :content="scope.row.published_at" placement="left-start">
                  <span>{{scope.row.published_at | onlyDate}}</span>
                </el-tooltip>
              </template>
            </el-table-column>
            <el-table-column label="分类">
              <template scope="scope">
                <el-tag type="primary" :key="item.id" v-for="item in scope.row.categories.data">{{item.cate_name}}</el-tag>
              </template>
            </el-table-column>
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
      if(this.activeIndex === null){
        return 'posts?include=categories'
      }else{
        return `categories/${this.activeIndex}/posts?include=categories`
      }
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
      res.data.unshift({
        id: null,
        cate_name: '全部'
      })
      this.allCategories = res.data
    })
  }
}
</script>

<style lang="less" scoped>
.article_list{
  .cate_tree_wrapper{
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    position: fixed;
    top: 80px;
    bottom: 10px;
    width: 190px;
    background-color: #fff;
    header{
      margin: 0;
      color: #333;
      border-color: #ddd;
      font-size: 18px;
      font-weight: 300;
      padding: 10px 15px;
      border-bottom: 1px solid #eee;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
      position: relative;
      h3{
        font-weight: 700;
        font-size: 14px;
        margin: 0;
        line-height: 35px;
      }
      .add_btn{
        position: absolute;
        right: 10px;
        top: 14px;
      }
    }
  }
  .main_list{
    padding-left: 200px;
  }
}
</style>