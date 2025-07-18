<template>
    <div class="mt-5">
        <form-supply
            save-button-label="Atualizar fornecedor"
            :form-type="'update'"
        ></form-supply>
    </div>
</template>

<script>
import FormSupply from '@/components/supplies/FormSupply.vue'

export default {
    components: {
        FormSupply
    }
}

</script>