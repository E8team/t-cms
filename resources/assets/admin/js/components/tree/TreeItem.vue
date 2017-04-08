<template>
  <div class="tree_item">
    <div :class="{'active': parentComp.currentIndex == model.id}" class="item">
      <span @click="parentComp.currentIndex = model.id">{{model.cate_name}}</span>
      <tree-item
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
    active: Number
  },
  data () {
    return {
      parentComp: {
        currentIndex: null
      }
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
  },
  components: {
  },
}
</script>
<style scoped lang="less">
.item{
  &.active{
    >span{
      background-color: #e4e4e4;
    }
  }
  >.item{
    padding-left: 15px;
  }
  >span{
    padding-left: 15px;
    line-height: 40px;
    font-size: 14px;
    color: #666;
    cursor: pointer;
    display: block;
    &:hover{
      background-color: #f1f1f1;
    }
  }
}
</style>
