<template>
    <div class="theme">
        <panel title="主题选择">
            <div class="theme_main">
                <el-row :gutter="10">
                    <el-col v-for="item in themeList" :key="item.theme_id" :xs="12" :sm="12" :md="8" :lg="6" class="theme_body" :class="{'current': item.is_current}">
                        <div class="theme_img">
                            <img :src="item.screenshot_url" :alt="item.name">
                            <div class="theme_enable_btn">
                                <el-button @click="startTheme(item.theme_id)" type="success">启 用</el-button>
                            </div>
                        </div>
                        <footer>
                            <h2>{{item.name}}{{item.is_current ? '(当前)' : ''}}<span> ({{item.version}})</span></h2>
                            <div class="author">
                                <span>作者: {{item.author}}</span>
                                <a class="text" :href="item.homepage" target="_blank">作者主页</a>
                            </div>
                        </footer>
                    </el-col>
                </el-row>
            </div>
        </panel>
    </div>
</template>

<script>
    export default {
        name: 'theme',
        data () {
            return {
                themeList: []
            }
        },
        mounted () {
            this.getThemes();
        },
        methods: {
            getThemes () {
                this.$http.get('themes').then(res => {
                    this.themeList = res.data
                })
            },
            startTheme(themeId){
                this.$http.put('themes/current_theme', {
                    params: {
                        theme_id: themeId
                    }
                }).then(res => {
                    this.getThemes();
                })
            }
        }
    }
</script>

<style lang="less" scoped>
    .theme_main>ul{
        margin: 0;
        padding: 0;
        overflow: hidden;    
    }
    .theme_body.current{
        border: 1px solid #20a0ff;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }
    .theme_body.current:hover>.theme_img>.theme_enable_btn{
        display: none!important;
    }
    .theme_body{
        cursor: pointer;
        float: left;
        margin: 0 4% 4% 0;
        position: relative;
        border: 1px solid #ddd;
        -webkit-box-shadow: 0 1px 1px -1px rgba(0,0,0,.1);
        box-shadow: 0 1px 1px -1px rgba(0,0,0,.1);
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        &:hover>.theme_img>.theme_enable_btn{
            display: block;
        }
        >.theme_img{
            display: block;
            overflow: hidden;
            position: relative;
            -webkit-backface-visibility: hidden;
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            >.theme_enable_btn{
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: none;
                background-color: rgba(0,0,0,.4);
                >.el-button{
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                }
            }
            &::after{
                content: "";
                display: block;
                padding-top: 66.66666%;
            }
            >img{
                height: 100%;
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                -webkit-transition: opacity .2s ease-in-out;
                transition: opacity .2s ease-in-out;
            }
        }
        >footer{
            padding: 15px;
            position: relative;
            >h2{
                margin: 0 0 15px 0;
                >span{
                    font-size: 14px;
                    color: #666;
                }
            }
            >.author>span{
                color: #666;
            }
            >.author>a{
                position: absolute;
                right: 10px;
                bottom: 13px;
                color: #20a0ff;
                text-decoration: none!important;
                font-size: 12px;
                &:hover,&:focus{
                    color: #4db3ff;
                }
            }
        }
    }
    .theme_body:nth-child(3n){
        margin-right: 0;
    }
</style>