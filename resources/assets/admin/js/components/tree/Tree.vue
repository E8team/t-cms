<template>
  <div class="tree" data-id="tree">
    <TreeItem
        v-for="modelItem in model"
        :key="modelItem.id"
        :model="modelItem"
        :root="true">
      </TreeItem>
  </div>
</template>

<script>
import TreeItem from './TreeItem.vue'
export default{
  name: 'tree',
  props: {
    model: Array,
    value: Number
  },
  data () {
    return {
      currentIndex: 0
    }
  },
  mounted () {
    this.currentIndex = this.value;
  },
  watch: {
    currentIndex (val, oldval) {
      if(val != oldval){
        this.$emit('input', val);
      }
    },
    'value' (val) {
        if (this.currentIndex !== val) {
            this.currentIndex = val
        }
    }
  },
  components: {
    TreeItem
  },
  methods: {
  }
}
</script>
<style scoped lang="less">

</style>
