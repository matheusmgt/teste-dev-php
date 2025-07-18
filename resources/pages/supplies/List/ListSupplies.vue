<template>
    <div class="mt-5">
        <list-supplies-header @filters="searchFilter"></list-supplies-header>
        <list-supplies-table  ref="listSuppliesTable"></list-supplies-table>
    </div>
</template>

<script>
import ListSuppliesHeader from '@/components/supplies/ListSuppliesHeader.vue'
import ListSuppliesTable from '@/components/supplies/ListSuppliesTable.vue'

export default {
    components: {
        ListSuppliesHeader,
        ListSuppliesTable,
    },

    methods: {
        searchFilter(filters) {
            this.$refs.listSuppliesTable.searchSupplies(filters)
        }
    }
}
</script>