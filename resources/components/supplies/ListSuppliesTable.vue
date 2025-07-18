<template>
    <v-data-table
      :headers="headers"
      :items="supplyData"
      class="elevation-1 text-dark w-100 mt-3"
      dense
    >
        <template #item.actions="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="viewItem(item)"
                color="primary"
            >
                mdi-eye
            </v-icon>
            <v-icon
                small
                class="mr-2"
                @click="editItem(item)"
                color="warning"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                small
                @click="deleteItem(item)"
                color="red"
            >
                mdi-delete
            </v-icon>
        </template>
        <template #item.document="{ item }">
            {{ item.cnpj ? item.cnpj : item.cpf }}
        </template>
    </v-data-table>
</template>

<script>
import { mapActions } from 'vuex'
import { toast } from 'vue3-toastify'

export default {
  methods: {
    ...mapActions('supply', ['getSupplies', 'delete']),

    editItem(item) {
      this.$router.push(`/supplies/edit-supply/${item.id}`)
    },
    viewItem(item) {
      this.$router.push(`/supplies/view-supply/${item.id}`)
    },

    deleteItem(item) {
      if (confirm('Deseja deletar esse registro?')) {
        this.delete(item.id).then(() => {
          toast.success('Registro deletado com sucesso.')
        }).finally(() => {
          this.searchSupplies()
        })
      }
    },

    async searchSupplies(filters) {
      this.supplyData = await this.getSupplies(filters)
    }
  },
  
  data() {
    return {
      headers: [
        { title: '', value: 'actions', sortable: false },
        { title: 'Tipo', value: 'type' },
        { title: 'Nome', value: 'name' },
        { title: 'Doc.', value: 'document' },
        { title: 'Telefone', value: 'phone' },
        { title: 'CEP', value: 'cep' },
        { title: 'Endereço', value: 'address' },
        { title: 'Número', value: 'address_number' },
        { title: 'Estado', value: 'state' },
        { title: 'Cidade', value: 'city' }
      ],
      supplyData: [],
    };
  },

  async created() {
    this.searchSupplies()
  }
};
</script>