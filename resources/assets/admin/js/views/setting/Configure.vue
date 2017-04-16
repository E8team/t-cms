<template>
  <div class="configure">
    <panel title="站点设置" style="width:800px;">
      <el-form :model="setting" label-width="100px" style="margin:20px 100px;">
            <el-form-item required label="网站标题">
                <el-input placeholder="请设置网站标题" v-model="setting.title"></el-input>
            </el-form-item>
            <el-form-item required label="副标题">
                <el-input placeholder="请设置副标题" v-model="setting.title"></el-input>
            </el-form-item>
            <el-form-item required label="ICP备案号">
                <el-input placeholder="请设置ICP备案号" v-model="setting.title"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button-group>
                    <el-button type="success" @click="confirm">保存更改</el-button>
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
      setting: {}
    }
  }
}
</script>