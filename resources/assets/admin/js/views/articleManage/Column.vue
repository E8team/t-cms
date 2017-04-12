<template>
  <div class="column">
    <panel :covered="false" :title="title">
        <el-form :model="column" label-width="85px">
            <el-form-item required label="栏目名">
                <el-input placeholder="请设置栏目名" v-model="column.cate_name"></el-input>
            </el-form-item>
            <el-form-item required label="父级栏目">
                <el-select v-model="column.parent_id" placeholder="请选择">
                    <el-option label="作为父级栏目" :value="0"></el-option>
                    <el-option v-for="item in topCategories" :key="item.id" :label="item.cate_name" :value="item.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item required label="栏目描述">
                <el-input placeholder="请输入栏目描述" type="textarea" :rows="2" v-model="column.description"></el-input>
            </el-form-item>
            <el-form-item label="栏目图片">
                <el-upload class="avatar-uploader"
                        accept="image/jpeg,image/png"
                        :action="`${$t_meta.base_url}/ajax_upload_picture`"
                        :with-credentials="true"
                        :headers="{'X-CSRF-TOKEN': $t_meta.csrfToken}"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload"
                        :show-file-list="false" >
                    <img v-if="column.image_urls.lg" :src="column.image_urls.lg" class="avatar" />
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>
            <el-form-item required label="排序">
                <el-input-number v-model="column.order"></el-input-number>
            </el-form-item>
            <el-form-item required label="栏目类型">
                <el-select v-model="column.type" placeholder="请选择">
                    <el-option label="列表栏目" :value="0"></el-option>
                    <el-option label="单网页" :value="1"></el-option>
                    <el-option label="外部链接" :value="2"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="设为导航">
                <el-switch
                    v-model="column.is_nav"
                    on-text="导航"
                    off-text="普通"
                    on-color="#13ce66"
                    off-color="#ff4949">
                </el-switch>
            </el-form-item>
            <el-form-item v-if="column.type != 2" required label="栏目slug">
                <el-input placeholder="请设置栏目slug" v-model="column.cate_slug"></el-input>
            </el-form-item>
            <el-form-item v-if="column.type == 2" label="外部链接">
                <el-input placeholder="请设置外部链接" v-model="column.url"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button-group>
                    <el-button type="success" @click="confirm">确认</el-button>
                    <el-button @click="$router.back()">取消</el-button>
                </el-button-group>
            </el-form-item>
        </el-form>
    </panel>
  </div>
</template>

<script>
export default{
  data () {
    return {
        column: {
            'type': 0,
            'image': null,
            'image_urls': [],
            'parent_id': 0,
            'cate_name': null,
            'description': null,
            'url': null,
            'cate_slug': null,
            'is_nav': null,
            'order': null,
            'page_template': null,
            'list_template': null,
            'content_template': null,
            'setting': null
        },
        topCategories: [],
        title: ''
    }
  },
  methods: {
    handleAvatarSuccess (res, file) {
    this.column.image_urls.lg = URL.createObjectURL(file.raw);
        this.$forceUpdate();
        this.column.image = res.picture;
    },
    beforeAvatarUpload(file) {
        const isPIC = file.type === 'image/jpeg' || file.type === 'image/png';
        if (!isPIC) {
            this.$message.error('上传头像图片只能是 JPG 或 PNG 格式!');
        }
        return isPIC;
    },
    confirm () {
    }
  },
  mounted () {
    this.$http.get('top_categories').then(res => {
        this.topCategories = res.data.data;
    });
    if (this.$route.name === 'column-edit') {
        this.id = this.$route.params.id;
        this.$http.get(`categories/${this.id}`).then(res => {
            this.column = res.data.data;
        });
        this.title = '编辑栏目';
      }else{
        this.title = '添加栏目';
      }
  }
}
</script>

<style lang="less">
.column{
    .avatar-uploader>.el-upload {
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        background-color: #fbfdff;
        border: 1px dashed #c0ccda;
    }
    .avatar-uploader>.el-upload:hover {
        border-color: #20a0ff;
        color: #20a0ff;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 148px;
        height: 148px;
        line-height: 148px;
        text-align: center;
    }
    .avatar {
        width: 148px;
        height: 148px;
        display: block;
    }
}
</style>