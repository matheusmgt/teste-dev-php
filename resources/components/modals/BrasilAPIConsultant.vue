<template>
  <div>
    <v-dialog v-model="dialog" max-width="600">
      <v-card>
        <v-card-title>Consulta de CNPJ</v-card-title>

        <v-card-text>
          <v-text-field
            v-model="cnpj"
            label="Digite o CNPJ"
            v-maska="'##.###.###/####-##'"
            placeholder="00.000.000/0000-00"
            clearable
          />
        </v-card-text>

        <v-card-actions>
            <v-spacer />
            <v-btn color="grey" variant="text" @click="closeModal">Fechar</v-btn>
            <v-btn color="success" @click="consultCNPJ" :loading="loading" :variation="'elevated'">
                Consultar
            </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from 'axios'
import { toast } from 'vue3-toastify'

export default {
  data() {
    return {
      dialog: false,
      cnpj: '',
    }
  },
  methods: {
    async consultCNPJ() {
        if (!(/^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/.test(this.cnpj))) {
            return toast.error('CNPJ inválido, verifique e tente novamente')
        }

        let cnpj = this.cnpj.replace(/\D/g, '')

        try {
            const response = await axios.get(`https://brasilapi.com.br/api/cnpj/v1/${cnpj}`)
            this.$emit('cnpj-data', response.data)
            toast.success('CNPJ encontrado com sucesso')
            this.closeModal()
        } catch (err) {
            toast.error('CNPJ não encontrado ou inválido.')
        } finally {
            this.loading = false
        }
    },
    closeModal() {
      this.dialog = false
      this.cnpj = ''
    },
    openModal() {
        this.dialog = true
        this.cnpj = ''
    }
  }
}
</script>