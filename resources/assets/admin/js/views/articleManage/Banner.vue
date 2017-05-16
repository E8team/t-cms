<template>
    <div class="banner">
        <panel :covered="false" :title="title">
            <el-form :model="banner" label-width="85px">
                <el-form-item :error="errors.title" label="标题">
                    <el-input @change="errors.url = ''" placeholder="请设置标题" required v-model="banner.title"></el-input>
                </el-form-item>
                <el-form-item :error="errors.url" label="URL">
                    <el-input @change="errors.url = ''" placeholder="请设置banner URL" required v-model="banner.url"></el-input>
                </el-form-item>
                <el-form-item label="分类">
                    <el-select v-model="banner.type_id" placeholder="请选择">
                        <el-option v-for="item in bannerTypes" :key="item.id" :label="item.name" :value="item.id"></el-option>
                    </el-select>
                    <el-button type="info" @click="typeDialogVisible = true">管理分类</el-button>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input-number v-model="banner.order"></el-input-number>
                </el-form-item>
                <el-form-item label="上传图片">
                    <el-upload
                            class="upload-banner"
                            drag
                            :show-file-list="false"
                            accept="image/jpeg,image/png"
                            :action="`${$t_meta.base_url}/ajax_upload_picture`"
                            :with-credentials="true"
                            :headers="{'X-CSRF-TOKEN': $t_meta.csrfToken}"
                            :on-success="handleAvatarSuccess"
                            :before-upload="beforeAvatarUpload">
                        <img v-if="banner.picture_urls.lg" :src="banner.picture_urls.lg" class="preview"/>
                        <template v-else>
                            <i class="el-icon-upload"></i>
                            <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                        </template>
                        <div class="el-upload__tip" slot="tip">只能上传 png/jpg 文件</div>
                    </el-upload>
                </el-form-item>
                <el-form-item label="是否显示">
                    <el-switch
                            v-model="banner.is_visible"
                            on-text="显示"
                            off-text="隐藏"
                            on-color="#13ce66"
                            off-color="#ff4949">
                    </el-switch>
                </el-form-item>
                <el-form-item>
                    <el-button-group>
                        <el-button type="success" @click="confirm">确认</el-button>
                        <el-button @click="$router.back()">取消</el-button>
                    </el-button-group>
                </el-form-item>
            </el-form>
        </panel>
        <TypeManagementDialog @new_type="refreshType()" type="banner" v-model="typeDialogVisible"></TypeManagementDialog>
    </div>
</template>
<script>
import TypeManagementDialog from '../../components/TypeManagementDialog.vue'
export default{
    data () {
        return {
            title: '',
            errors: {},
            banner: {
                'url': null,
                'title': null,
                'picture': null,
                'type_id': null,
                'order': null,
                'is_visible': true,
                'picture_urls': {}
            },
            bannerTypes: [],
            typeDialogVisible: false
        }
    },
    components: {
        TypeManagementDialog
    },
    methods: {
        handleAvatarSuccess (res, file) {
            this.banner.picture_urls.lg = URL.createObjectURL(file.raw);
            this.$forceUpdate();
            this.banner.picture = res.picture;
        },
        beforeAvatarUpload(file) {
            const isPIC = file.type === 'image/jpeg' || file.type === 'image/png';
            if (!isPIC) {
                this.$message.error('上传头像图片只能是 JPG 或 PNG 格式!');
            }
            return isPIC;
        },
        refreshType () {
            this.$http.get('types/banner').then(res => {
                this.bannerTypes =  res.data.data;
            });
        },
        confirm () {
            let method, url;
            this.id ? (method = 'put', url = `banners/${this.id}`) : (method = 'post', url = 'banners');
            this.$http[method](url, this.$diff.diff(this.banner)).then(res => {
                this.$message({
                    message: `${this.title}成功`,
                    type: 'success'
                });
                this.$router.push({name: 'banners'});
            }).catch(err => {
                this.errors = err.response.data.errors;
            });
        },
    },
    mounted () {
        this.refreshType();
        if (this.$route.name === 'banner-edit') {
            this.id = this.$route.params.id;
            this.$http.get(`banners/${this.id}`).then(res => {
                this.banner = res.data.data;
                this.$diff.save(this.banner);
            });
            this.title = '编辑banner';
        }else{
            this.title = '添加banner';
        }
    }
}
</script>

<style lang="less">
    .banner{
        .upload-banner{
            .el-upload__tip{
                margin-top: 0;
                line-height: 25px;
            }
            .preview{
                width: 100%;
            }
        }
    }
</style>



