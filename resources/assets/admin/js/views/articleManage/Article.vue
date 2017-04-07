<template>
  <div class="article">
    <panel title="撰写新文章" class="main">
       <el-form label-position="top" :model="article">
          <el-form-item required label="标题">
              <el-input placeholder="在此输入标题" size="large"></el-input>
          </el-form-item>
          <el-form-item label="作者信息">
              <el-input placeholder="请输入作者信息" type="textarea" :rows="2"></el-input>
          </el-form-item>
          <el-form-item label="摘要">
              <el-input placeholder="请输入摘要" type="textarea" :rows="3"></el-input>
              <div class="tip">选填，如果不填写会默认抓取正文前54个字</div>
          </el-form-item>
          <el-form-item label="封面">
              <el-button type="success">从正文选择</el-button>
              <el-button type="info">本地上传</el-button>
              <div class="tip">大图片建议尺寸：900像素 * 500像素</div>
          </el-form-item>
          <div id="ueditor_wrapper"></div>
       </el-form>
    </panel>
    <div class="postbox_container">
      <panel title="分类" size="small">
        <el-checkbox-group v-model="article.category_ids">
        <el-tree
          :render-content="renderCategorie"
          :data="topCategories"
          lazy
          :props= 'props'
          :load='loadCategorie'>
        </el-tree>
        </el-checkbox-group>
      </panel>
      <panel title="发布" size="small">
        <el-form label-position="top" :model="article">
          <el-form-item label="浏览次数">
              <el-input-number v-model="article.views_count"></el-input-number>
          </el-form-item>
          <el-form-item label="浏览次数">
              <el-date-picker
                v-model="article.created_at"
                type="datetime"
                placeholder="选择日期时间"
                align="right"
              >
              </el-date-picker>
          </el-form-item>
          <el-form-item label="正文模板">
              <el-select v-model="article.template" placeholder="请选择">
                <el-option
                  :key="item.file_name"
                  v-for="item in contentTemplates"
                  :label="item.title"
                  :value="item.file_name">
                </el-option>
              </el-select>
          </el-form-item>
          <el-button type="success">发布</el-button>
        </el-form>
      </panel>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'article',
    methods: {
      loadCategorie (node, resolve) {
        if (node.level === 0) {
          return;
        }
        this.$http.get(`categories/${node.data.id}/children`).then(res => {
          return resolve(res.data.data)
        })
      },
      renderCategorie(h, { node, data, store }) {
        return (<span style="overflow: hidden"><el-checkbox label={node.data.id}>{node.label}</el-checkbox></span>);
      }
    },
    beforeCreate () {
      for(let item of window.t_meta.ueditor_include){
        let scriptNode = document.createElement("script");
        scriptNode.setAttribute("type", "text/javascript");
        scriptNode.setAttribute("src",item);
        scriptNode.setAttribute('data-type', 'ueditor_include')
        document.body.appendChild(scriptNode);
      }
    },
    mounted () {
      let ueditorNode = document.createElement("script");
      ueditorNode.setAttribute('id', 'ueditor_container');
      ueditorNode.setAttribute('name', 'content');
      ueditorNode.setAttribute('type', 'text/plain');
      document.querySelector('#ueditor_wrapper').appendChild(ueditorNode);
      window.onload = () => {
        let ue = window.UE.getEditor('ueditor_container');
        ue.ready(function() {
          ue.execCommand('serverparam', '_token', window.t_meta.csrfToken);
        });
      }
      this.$http.get('top_categories').then(res => {
        this.topCategories = res.data.data
      })
      this.$http.get('themes/content_template').then(res => {
        this.contentTemplates = res.data
      })
    },
    beforeDestroy () {
      document.querySelectorAll('[data-type=ueditor_include]').forEach(function(element) {
        document.body.removeChild(element);
      }, this);
    },
    data () {
      return{
        props: {
          label: 'cate_name',
          children: 'cate_name'
        },
        topCategories: [],
        contentTemplates: [],
        article: {
          'title': null,
          'author_info': null,
          'excerpt': null,
          'content': null,
          'cover': null,
          'type': null,
          'views_count': null,
          'order': null,
          'template': null,
          'category_ids': [],
          'created_at': null
        }
      }
    }
  }
</script>

<style lang="less">
  .article{
    display: flex;
    .main{
      flex: 1;
      margin-right: 20px;
      .tip{
        font-size: 12px;
        color: #999;
        position: relative;
        top: -3px;
      }
      #ueditor_wrapper{
        overflow: hidden;
        #edui1,#edui1_iframeholder{
          width: 100%!important;
        }
      }
    }
    .postbox_container{
      height: 100%;
      width: 300px;
    }
  }
</style>