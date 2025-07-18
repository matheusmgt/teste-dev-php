<template>
  <div>
    <v-btn @click="$router.push('/supplies/create-supply')" variant="elevated" color="success" prepend-icon="mdi-plus" class="mr-2" size="small">
      CRIAR NOVO FORNECEDOR
    </v-btn>
    <v-btn @click="show = !show" variant="elevated" color="primary" prepend-icon="mdi-filter" size="small">
      {{ show ? 'Ocultar Filtros' : 'Mostrar Filtros' }}
    </v-btn>

    <v-expand-transition>
      <v-card v-if="show" class="mt-4" elevation="2">
        <v-card-text>
          <v-form @submit.prevent="emitFilters">
            <v-row dense>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="filters.search"
                  label="Buscar (Nome, CPF, CNPJ, Razão Social, Nome Fantasia, Endereço)"
                  prepend-inner-icon="mdi-magnify"
                  clearable
                />
              </v-col>
              <v-col cols="12" md="4">
                <v-select
                  v-model="filters.category"
                  :items="typeOfSupply"
                  label="Tipo do Fornecedor (PF/PJ)"
                  clearable
                  prepend-inner-icon="mdi-format-list-bulleted"
                />
              </v-col>
              <v-col cols="12" md="4">
                <v-select
                  v-model="filters.uf"
                  :items="listOfStates"
                  label="Estado"
                  clearable
                  prepend-inner-icon="mdi-map-marker"
                />
              </v-col>
            </v-row>
            <div class="d-flex justify-center">
                <center>
                    <v-btn @click="clearFilters" type="submit" color="grey" class="mr-3" variant="text" prepend-icon="mdi-delete" size="small">
                        Limpar Filtro
                    </v-btn>
                    <v-btn @click="emitFilters" type="submit" color="primary" size="small">
                        Aplicar Filtro
                    </v-btn>
                </center>
            </div>
          </v-form>
        </v-card-text>
      </v-card>
    </v-expand-transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filters: this.defaultFiltersOptions(),
      listOfStates: [
        "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA",
        "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN",
        "RS", "RO", "RR", "SC", "SP", "SE", "TO"
      ],
      typeOfSupply: ['PF', 'PJ'],
      show: false,
    }
  },

  methods: {
    emitFilters() {
      this.$emit('filters', this.filters)
    },

    defaultFiltersOptions() {
      return {
        search: '',
        category: '',
        uf: '',
      }
    },

    clearFilters() {
      this.filters = this.defaultFiltersOptions()
      this.emitFilters()
    }
  }
}
</script>