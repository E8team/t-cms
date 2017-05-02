<template>
    <div>
        <nprogress-container></nprogress-container>
        <router-view></router-view>
    </div>
</template>


<script>
    import NprogressContainer from 'vue-nprogress/src/NprogressContainer'
    export default{
        name: 'app',
        components: {
            NprogressContainer
        },
        mounted () {
        }
    }
</script>

<style lang="less">
    .nprogress-container{
        position: fixed!important;
        width: 100%;
        z-index: 9999;
        top: 0;
        height: 2px;
        #nprogress .spinner{
            position: fixed!important;
        }
    }
</style>