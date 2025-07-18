<template>
    <div class="mt-5">
        <form-supply
            :form-type="'view'"
        ></form-supply>
    </div>
</template>

<script>
import FormSupply from '@/components/supplies/FormSupply.vue'

export default {
    components: {
        FormSupply
    },
}

</script>