<template>
  <div :class="{'close': !root && !isOpen}" class="tree_item">
    <div :class="{'active': parentComp.currentIndex == model.id}" class="item">
      <div v-if="root && model.children.length > 0" class="toggle" :class="{'open': root && isOpen}" @click="toggle($event)">
        <i class="el-icon-caret-right"></i>
      </div>
      <span :class="{'root': root}" @click="parentComp.currentIndex = model.id">{{model.cate_name}}</span>
      <tree-item
        v-if="model.type != 2"
        :root="false"
        class="item"
        :key="model.id"
        v-for="model in model.children"
        :model="model">
      </tree-item>
    </div>
  </div>
</template>

<script>
export default{
  name: 'treeItem',
  props: {
    model: Object,
    active: Number,
    root: Boolean
  },
  data () {
    return {
      parentComp: {
        currentIndex: null
      },
      isOpen: false
    }
  },
  mounted () {
    let parent = this.$parent;
    while(parent.$el.getAttribute('data-id') !== 'tree'){
      parent = parent.$parent;
    }
    this.parentComp = parent;
  },
  methods: {
      toggle (event) {
        let allChildDom = event.currentTarget.parentNode.querySelectorAll('.tree_item.item');
        allChildDom.forEach(item => {
          if(this.isOpen){
              item.style.display = 'none';
          }else{
              item.style.display = 'block';
          }
        });
        this.isOpen = !this.isOpen;
      }
  },
  components: {
  },
}
</script>
<style scoped lang="less">
.item{
  position: relative;
  display: block;
  &.close{
    display: none;
  }
  &.active{
    >span{
      background-color: #F3F8FF;
      color: #609ee9;
    }
  }
  >.item{
    padding-left: 10px;
  }
  .toggle{
    position: absolute;
    left: 0;
    top: 0;
    color: #999;
    font-size: 12px;
    display: block;
    width: 27px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    cursor: pointer;
    >i{
      transition: transform .3s;
    }
    &.open{
      >i{
         transform: rotate(90deg);
       }
    }
  }
  >span{
    padding-left: 15px;
    line-height: 40px;
    font-size: 12px;
    color: #666;
    cursor: pointer;
    display: block;
    &:hover{
      background-color: #f9f9f9;
    }
    &.root{
      padding-left: 25px;
    }
  }
}
</style>
