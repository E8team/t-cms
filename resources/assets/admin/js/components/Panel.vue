<template>
  <div class="panel" :style="{'width': width}" :class="size">
    <header>
      <h2>{{title}}</h2>
      <div class="header_right">
        <slot name="header"></slot>
      </div>
    </header>
    <el-row :gutter="10">
      <el-col class="body" :xs="24" :sm="18" :md="12" :lg="10" :class="{'covered': covered}">
        <slot></slot>
      </el-col>
    </el-row>
    <footer v-if="$slots['footer'] !== undefined">
      <slot name="footer"></slot>
    </footer>
  </div>
</template>

<script>
export default{
  name: 'panel',
  props: {
    title: {
      type: String,
      required: true
    },
    covered: {
      type: Boolean,
      default: true
    },
    width: {
      type: String,
      default: 'auto'
    },
    size: {
      type: String,
      default: 'large'
    }
  }
}
</script>
<style scoped lang="less">
  .panel{
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    height: 100%;
    &.small{
      header{
        h2{
          height: 45px;
          font-size: 16px;
          line-height: 24px;
          padding-left: 15px;
        }
      } 
    }
    header{
      position: relative;
      z-index: 10;
      >h2{
        margin: 0;
        color: #333;
        border-color: #ddd;
        font-size: 18px;
        font-weight: 300;
        letter-spacing: 0.025em;
        height: 66px;
        line-height: 45px;
        padding: 10px 15px;
        border-bottom: 1px solid #eee;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
      }
      >.header_right{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translate(0,-50%);
      }
    }
    .el-row{
      margin: 0!important;
    }
    .body{
      padding: 30px 15px;
      float: inherit;
      margin: 0 auto;
      &.covered{
        padding: 10px 15px!important;
        width: 100%!important;
      }
    }
    footer{
      padding: 0 0 10px 15px;
      overflow: hidden;
    }
  }
</style>
