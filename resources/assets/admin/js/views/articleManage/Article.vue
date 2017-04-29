<template>
  <div class="article">
    <panel title="撰写新文章" class="main">
       <el-form label-position="top" :model="article">
          <el-form-item required label="标题">
              <el-input v-model="article.title" placeholder="在此输入标题"></el-input>
          </el-form-item>
          <el-form-item label="作者信息">
              <el-input v-model="article.author_info" placeholder="请输入作者信息"></el-input>
          </el-form-item>
          <el-form-item id="ueditor_wrapper"></el-form-item>
          <el-form-item label="摘要">
              <el-input v-model="article.excerpt" placeholder="请输入摘要" type="textarea" :rows="3"></el-input>
              <div class="tip">选填，如果不填写会默认抓取正文前54个字</div>
          </el-form-item>
       </el-form>
    </panel>
    <div class="postbox_container">
      <panel title="栏目" size="small">
        <el-checkbox-group v-model="article.category_ids">
        <el-tree
          default-expand-all
          :render-content="renderCategorie"
          :data="allCategories"
          :props= 'props'>
        </el-tree>
        </el-checkbox-group>
      </panel>
      <panel title="发布" size="small">
        <el-form label-position="top" :model="article">
          <el-form-item required label="发布时间">
              <el-date-picker
                v-model="article.published_at"
                type="datetime"
                placeholder="选择日期时间"
                align="right">
              </el-date-picker>
          </el-form-item>
          <el-form-item required label="正文模板">
              <el-select v-model="article.template" placeholder="请选择">
                <el-option
                  :key="item.file_name"
                  v-for="item in contentTemplates"
                  :label="item.title"
                  :value="item.file_name">
                </el-option>
              </el-select>
          </el-form-item>
          <el-form-item required label="浏览次数">
              <el-input-number :min="0" v-model="article.views_count"></el-input-number>
          </el-form-item>
          <el-button-group class="public_btn">
              <el-button type="success" @click="confirm" :loading="confirmLoading">{{confirmBtnTitle}}</el-button>
              <el-button @click="$router.back()">返回</el-button>
          </el-button-group>
        </el-form>
      </panel>
      <panel title="封面" size="small">
        <!--<el-form-item required label="封面">-->
        <div class="cover_box">
          <el-button size="small" @click="selImageDialog = true" type="success">从正文选择</el-button>
          <el-upload
            class="upload_cover"
            accept="image/jpeg,image/png"
            :action="`${$t_meta.base_url}/ajax_upload_picture`"
            :with-credentials="true"
            :headers="{'X-CSRF-TOKEN': $t_meta.csrfToken}"
            :on-success="handleCoverSuccess"
            :before-upload="beforeCoverUpload"
            :show-file-list="false"
            >
            <el-button type="info" size="small" >本地上传</el-button>
          </el-upload>
        </div>
        <div class="tip">封面图片建议尺寸：900像素 * 500像素</div>
          <!--</el-form-item>-->
        <div class="cover_preview" v-if="preViewCover != null">
          <img :src="preViewCover"/>
        </div>
      </panel>
    </div>
    <el-dialog title="从正文中选择图片" v-model="selImageDialog">
      <ul class="img_list">
        <div class="no_img" v-if="contentImages.length == 0"><i class="el-icon-warning"></i>没有找到图片</div>
        <li :class="{'active': selImageIndex == index}" v-for="(item, index) in contentImages"><img :src="item.src" @click="selImageIndex = index"/></li>
      </ul>
      <span slot="footer" class="dialog-footer">
        <el-button @click="selImageDialog = false">取 消</el-button>
        <el-button type="primary" @click="selImageDialog = false, selImage()">选 择</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  export default {
    name: 'article',
    methods: {
      confirm () {
        let method, url;
        this.id ? (method = 'put', url = `posts/${this.id}`) : (method = 'post', url = 'posts');
        this.article.content = this.articleContent;
        this.confirmLoading = true;
        this.$http[method](url, this.$diff.diff(this.article)).then(res => {
          this.$message({
              message: `${this.title}成功`,
              type: 'success'
          });
          this.confirmLoading = false;
          this.$router.push({name: 'articles'});
        }).catch(err => {
          this.confirmLoading = false;
        })
      },
      selImage () {
        this.preViewCover = this.contentImages[this.selImageIndex].src;
        this.article.cover_in_content = this.preViewCover;
      },
      handleCoverSuccess (res, file) {
        this.preViewCover = window.URL.createObjectURL(file.raw);
        this.article.cover = res.picture;
      },
      beforeCoverUpload (file) {
        const isPIC = file.type === 'image/jpeg' || file.type === 'image/png';
        if (!isPIC) {
            this.$message.error('上传头像图片只能是 JPG 或 PNG 格式!');
        }
        return isPIC;
      },
      loadCategorie (node, resolve) {
        if (node.level === 0) {
          return;
        }
        this.$http.get(`categories/${node.data.id}/children`,{
          params: {
            type: 'post'
          }
        }).then(res => {
          return resolve(res.data.data);
        })
      },
      renderCategorie(h, { node, data, store }) {
        return (<span style="overflow: hidden"><el-checkbox label={node.data.id}>{node.label}</el-checkbox></span>);
      },
      initEditor () {
        this.editorInited = true;
        window.UEDITOR_CONFIG.serverUrl = window.t_meta.ueditor_server_url;
        this.editor = window.UE.getEditor('ueditor_container', {
          initialFrameHeight: 300
        });
        this.editor.ready(() => {
          this.editor.execCommand('serverparam', '_token', window.t_meta.csrfToken);
          if(this.id){
            this.$http.get(`posts/${this.id}`, {
              params: {
                include: 'content, categories'
              }
            }).then(res => {
                res.data.data.category_ids = res.data.meta.cate_ids;
                this.article = res.data.data
                if(this.article.cover){
                  this.preViewCover = this.article.cover_urls.lg;
                }
                this.$diff.save(this.article);
                this.editor.setContent(this.article.content ? this.article.content.data.content : '');
            });
          }
        });
      }
    },
    beforeCreate () {
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
      
      this.$http.get('categories/all', {
        params: {
          type: 'post'
        }
      }).then(res => {
        this.allCategories = res.data;
      })
      this.$http.get('themes/content_template').then(res => {
        this.contentTemplates = res.data
        this.article.template = this.contentTemplates.find(item => item.is_defalut).file_name;
      })
      if (this.$route.name === 'article-edit') {
        this.id = this.$route.params.id;
        this.title = '编辑文章';
        this.confirmBtnTitle = '确认编辑';
      }else{
        this.title = '撰写新文章';
        this.confirmBtnTitle = '确认发布';
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
    data () {
      return{
        id: null,
        confirmBtnTitle: '',
        confirmLoading: false,
        editorInited: false,
        selImageDialog: false,
        contentImages: [],
        selImageIndex: null,
        props: {
          label: 'cate_name',
          children: 'children'
        },
        allCategories: [],
        contentTemplates: [],
        preViewCover: null,
        editor: null,
        article: {
          'title': null,
          'author_info': null,
          'excerpt': null,
          'content': null,
          'cover': null,
          'type': 'post',
          'views_count': null,
          'order': null,
          'template': null,
          'category_ids': [],
          'published_at': null
        }
      }
    },
    watch: {
      'selImageDialog' (val) {
        if(val){
          let ueditorDom = document.querySelector('#ueditor_0');
          if(ueditorDom){
            this.contentImages = ueditorDom.contentDocument.querySelectorAll('img')
          }
        }
      }
    },
    computed: {
      'articleContent' () {
        if(this.editor)
          return this.editor.getContent();
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
      .public_btn{
        position: relative;
        top: -10px;
      }
    }
    .cover_box{
      margin-bottom: 20px;
      .upload_cover{
        float:left;
        margin-right: 10px;
      }
    }
    .cover_preview{
      margin-top: 20px;
      >img{
        max-width: 100%;
      }
    }
    .tip{
      font-size: 12px;
      color: #999;
      position: relative;
      top: -3px;
    }
    .img_list{
      overflow: hidden;
      padding: 0;
      .no_img{
        background: #f5f5f5;
        line-height: 200px;
        color: #666;
        font-size: 14px;
        text-align: center;
        i{
          margin-right: 10px;
        }
      }
      li{
        padding: 20px;
        list-style: none;
        float: left;
        width: 25%;
        position: relative;
        &.active::after{
          content: '';
          background-color: #20A0FF;
          z-index: -1;
          position: absolute;
          top: 15px;
          left: 15px;
          right: 15px;
          bottom: 17px;
        }
        img{
          width: 100%;
          cursor: pointer;
          height: 125px;
        }
      }
    }
  }
  .el-scrollbar__wrap{
    margin-bottom: 0!important;
    overflow-x: hidden;
  }
</style>