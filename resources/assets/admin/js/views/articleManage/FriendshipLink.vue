<template>
    <div class="friendship_link">
        <panel :covered="false" :title="title">
            <el-form :model="friendshipLink" label-width="85px">
                <el-form-item :error="errors.url" required label="URL">
                    <el-input @change="errors.url = ''" placeholder="请设置友情链接URL" v-model="friendshipLink.url"></el-input>
                </el-form-item>
                <el-form-item required :error="errors.name" label="链接名称">
                    <el-input @change="errors.name = ''" placeholder="请设置友情链接的名称" v-model="friendshipLink.name"></el-input>
                </el-form-item>
                <el-form-item label="联系人">
                    <el-input @change="errors.linkman = ''" placeholder="请设置联系人" v-model="friendshipLink.linkman"></el-input>
                </el-form-item>
                <el-form-item label="分类">
                    <el-select v-model="friendshipLink.type_id" placeholder="请选择">
                        <el-option v-for="item in linkTypes" :key="item.id" :label="item.name" :value="item.id"></el-option>
                    </el-select>
                    <el-button type="info" @click="typeDialogVisible = true">管理分类</el-button>
                </el-form-item>
                <el-form-item label="链接logo">
                    <el-upload class="avatar-uploader"
                               accept="image/jpeg,image/png"
                               :action="`${$t_meta.base_url}/ajax_upload_picture`"
                               :with-credentials="true"
                               :headers="{'X-CSRF-TOKEN': $t_meta.csrfToken}"
                               :on-success="handleAvatarSuccess"
                               :before-upload="beforeAvatarUpload"
                               :show-file-list="false" >
                        <img v-if="friendshipLink.logo_urls.lg" :src="friendshipLink.logo_urls.lg" class="avatar" />
                        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                    </el-upload>
                </el-form-item>
                <el-form-item label="排序">
                    <el-input-number v-model="friendshipLink.order"></el-input-number>
                </el-form-item>
                <el-form-item label="是否显示">
                    <el-switch
                            v-model="friendshipLink.is_visible"
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
        <TypeManagementDialog @new_type="refreshType" type="link" v-model="typeDialogVisible"></TypeManagementDialog>
    </div>
</template>

<script>
    import TypeManagementDialog from '../../components/TypeManagementDialog.vue'
    export default{
        data () {
            return {
                typeDialogVisible: false,
                errors: [],
                linkTypes: [],
                friendshipLink: {
                    'url': null,
                    'name': null,
                    'logo': null,
                    'linkman': null,
                    'type_id': null,
                    'order': null,
                    'logo_urls': {},
                    'is_visible': true
                },
                title: ''
            }
        },
        components: {
            TypeManagementDialog
        },
        methods: {
            handleAvatarSuccess (res, file) {
                this.friendshipLink.logo_urls.lg = URL.createObjectURL(file.raw);
                this.$forceUpdate();
                this.friendshipLink.logo = res.picture;
            },
            beforeAvatarUpload(file) {
                const isPIC = file.type === 'image/jpeg' || file.type === 'image/png';
                if (!isPIC) {
                    this.$message.error('上传头像图片只能是 JPG 或 PNG 格式!');
                }
                return isPIC;
            },
            refreshType (typeList) {
                if(typeList){
                    this.linkTypes = typeList;
                }else {
                    this.$http.get('types/link').then(res => {
                        this.linkTypes = res.data.data;
                    });
                }
            },
            confirm () {
                let method, url;
                this.id ? (method = 'put', url = `links/${this.id}`) : (method = 'post', url = 'links');
                this.$http[method](url, this.$diff.diff(this.friendshipLink)).then(res => {
                    this.$message({
                        message: `${this.title}成功`,
                        type: 'success'
                    });
                    this.$router.push({name: 'friendship-links'});
                }).catch(err => {
                    this.errors = err.response.data.errors;
                });
            }
        },
        mounted () {
            this.refreshType();
            if (this.$route.name === 'friendship-link-edit') {
                this.id = this.$route.params.id;
                this.$http.get(`links/${this.id}`).then(res => {
                    this.friendshipLink = res.data.data;
                    this.$diff.save(this.friendshipLink);
                });
                this.title = '编辑友情链接';
            }else{
                this.title = '添加友情链接';
            }
        }
    }
</script>

<style lang="less">

</style>