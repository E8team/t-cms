<template>
    <div class="users">
        <CurrencyListPage title="用户列表" queryName="users"></CurrencyListPage>
    </div>
</template>

<script>
    import CurrencyListPage from '../../components/CurrencyListPage.vue'
    export default{
        components: {
            CurrencyListPage
        }
    }
</script>