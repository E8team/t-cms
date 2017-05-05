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
      <div v-show="currnetType == -1" class="default_show">
        <p class="info">一篇文章可以发布到多个栏目哦</p>
        <el-button type="primary"  @click="$router.push({name: 'article-add'})">撰写新文章</el-button>
      </div>
      <CurrencyListPage v-show="currnetType == 0" :title="currentTitle" ref="list" :queryName="queryName">
        <template scope="list">
          <el-tabs v-model="activeTab">
            <el-tab-pane label="默认" name="default"></el-tab-pane>
            <el-tab-pane label="回收站" name="trashed"></el-tab-pane>
          </el-tabs>
          <el-table border :data="list.data" style="width: 100%">
            <el-table-column width="340px" label="标题">
              <template scope="scope">
                <el-tag class="tag" type="danger" v-if="scope.row.top">置顶</el-tag>
                <el-tag class="tag" type="gray" v-if="scope.row.status == 'draft'">草稿</el-tag>
                <a :href="scope.row.url" class="title" target="_blank">{{scope.row.title}}</a>
              </template>
            </el-table-column>
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
                      <el-button v-if="activeTab == 'default'" size="mini" @click="$router.push({name: 'article-edit', params: {id: scope.row.id}})" type="warning">编辑</el-button>
                      <el-button v-else size="mini" @click="restore(scope.row.id)" type="success">还原</el-button>
                      <el-button @click="del(scope.row.id)" size="mini" type="danger">删除</el-button>
                  </el-button-group>
              </template>
          </el-table-column>
          </el-table>
        </template>
      </CurrencyListPage>
      <panel v-show="currnetType == 1" :title="currentTitle">
        <el-form :model="page" label-width="105px" label-position="top">
          <el-form-item label-width="105px" label="标题">
            <el-input placeholder="请输入标题" v-model="page.title"></el-input>
          </el-form-item>
          <el-form-item>
            <div id="ueditor_wrapper"></div>
          </el-form-item>
        </el-form>
        <el-button @click="confirm" type="success">提交</el-button>
      </panel>
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
      activeTab: 'default',
      props: {
        label: 'cate_name',
        children: 'children'
      },
      page: {
        title: '',
        content: ''
      },
      allCategories: [],
      activeIndex: null,
      currnetType: -1,
      currentTitle: '文章列表',
      editorInited: false,
      editor: null
    }
  },
  beforeDestroy () {
    try {
      this.editor.destroy();
    } catch (e) {
    }finally{
      this.editor = null
    }
    document.querySelectorAll('[data-type=ueditor_include]').forEach(function(element) {
      document.body.removeChild(element);
    }, this);
  },
  components: {
    CurrencyListPage, Tree
  },
  computed: {
    queryName () {
      if(this.activeIndex === null){
        // return 'posts?include=categories'
        return null;
      }else{
        let defaultUrl = `categories/${this.activeIndex}/posts?include=categories`;
        if(this.activeTab == 'trashed'){
            defaultUrl += "&only_trashed=true";
        }
        return defaultUrl;
      }
    }
  },
  watch: {
    activeTab () {
        this.$refs['list'].refresh(this.queryName);
    },
    '$route' (to, from) {
        this.activeIndex = this.$route.params.column;
    },
    activeIndex () {
      this.$router.push({name: 'articles', params: {column: this.activeIndex}});
      let res = {};
      this.search(this.activeIndex, this.allCategories, res);
      let current = res.current;
      this.currnetType = current.type;
      this.currentTitle = current.cate_name;
      if(this.currnetType == 0){
        let listRef = this.$refs['list'];
        if(listRef){
          listRef.refresh(this.queryName);
        }
      }else{
        this.page.title = '';
        this.page.content = '';
        this.editor.setContent(this.page.content);
        this.$http.get(`categories/${this.activeIndex}/page`, {
          params: {
            include: 'content'
          }
        }).then(res => {
          if(res.data){
            this.page.title = res.data.data.title;
            this.page.content = res.data.data.content.data.content;
            this.editor.setContent(this.page.content);
          }
        })
      }
    }
  },
  methods: {
    search (id, list, res) {
      if(res.current)return;
      for(let item of list){
        if(item.id == id){
          res.current =  item;
          return;
        }
        if(item.children){
          this.search(id, item.children, res);
        }
      }
    },
    confirm () {
      this.page.content = this.editor.getContent();
      this.$http.post(`categories/${this.activeIndex}/page`, this.page).then(res => {
        this.$message({
            message: '已保存',
            type: 'success'
        });
      })
    },
    initEditor () {
      this.editorInited = true;
      window.UEDITOR_CONFIG.serverUrl = window.t_meta.ueditor_server_url;
      this.editor = window.UE.getEditor('ueditor_container', {
        initialFrameHeight: 300
      });
      this.editor.ready(() => {
        this.editor.execCommand('serverparam', '_token', window.t_meta.csrfToken);
      });
    },
    restore (id) {
        this.$http.post(`posts/${id}/restore`).then(res => {
            this.$message('已还原');
            this.$refs['list'].refresh()
        })
    },
    del (id) {
        this.$confirm(this.activeTab == 'default' ? '你确定要删除该文章?' : '在回收站中删除该文章将无法恢复你确定要删除？', '提示', {
            confirmButtonText: '确定',
            cancelButtonText: '取消',
            type: 'warning'
        }).then(() => {
            this.$http.delete(`posts/${id}`).then(res => {
                this.$message('已删除');
                this.$refs['list'].refresh()
            })
        }).catch(() => {
        })
    }
  },
  mounted () {
    if(document.querySelectorAll('[data-type=ueditor_include]').length == 0){
      for(let item of window.t_meta.ueditor_include){
          let scriptNode = document.createElement("script");
          scriptNode.setAttribute("type", "text/javascript");
          scriptNode.setAttribute("src",item);
          scriptNode.setAttribute('data-type', 'ueditor_include')
          scriptNode.onload = () => {
            if(window.UE.getEditor != undefined && this.editorInited == false){
              this.initEditor()
            }
          }
          document.body.appendChild(scriptNode);
        }
    }
    let ueditorNode = document.createElement("script");
    ueditorNode.setAttribute('id', 'ueditor_container');
    ueditorNode.setAttribute('name', 'content');
    ueditorNode.setAttribute('type', 'text/plain');
    document.querySelector('#ueditor_wrapper').appendChild(ueditorNode);
    this.$http.get('categories/all').then(res => {
      this.allCategories = res.data.filter(item => item.type != 2);
      this.activeIndex = Number(this.$route.params.column);
    })
  }
}
</script>

<style lang="less">
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
    .tag{
      margin-right: 10px;
    }
    .title{
      color: #2476B4;
      text-decoration: none;
    }
    #ueditor_wrapper{
      overflow: hidden;
      #edui1 {
        width: 100%!important;
      }
      #edui1_toolbarbox{
        line-height: 1.5!important;
      }
    }
  }
  .default_show{
    text-align: center;
    padding: 150px 0;
    background-color: #fff;
    border-radius: 3px;
    .info{
      line-height: 14px;
      font-size: 12px;
      color: #6d757a;
    }
  }
}
</style>