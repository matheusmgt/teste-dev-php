<template>
    <v-card class="pa-5 mt-5">
        <div class="d-flex mb-5">
            <v-btn @click="$router.push('/supplies')" variant="elevated" color="primary" prepend-icon="mdi-arrow-left" size="small">
                VOLTAR
            </v-btn>
            <v-btn v-if="supplyData.type === 'PJ' && formType == 'create'" @click="openBrasilAPIModal" variant="elevated" color="primary" prepend-icon="mdi-search-web" size="small" class="ml-3">
                CONSULTAR BRASILAPI
            </v-btn>
        </div>
        <v-form ref="supplyForm" @submit.prevent="createOrUpdateSupply">
            <v-row dense>
                <v-col cols="12" lg="4">
                    <v-radio-group v-model="supplyData.type" label="Tipo do Fornecedor" @change="changedSupplyType" :disabled="disableInput">
                        <v-radio v-for="type in supplyTypeOptions" :label="type.label" :value="type.value"></v-radio>
                    </v-radio-group>
                </v-col>

                <v-col cols="12">
                    <v-row v-if="supplyData.type == 'PF'">
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Nome do Fornecedor'" v-model="supplyData.name" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'CPF do Fornecedor'" v-model="supplyData.cpf" v-maska="'###.###.###-##'" :rules="[rules.required, rules.cpf]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Telefone'" v-model="supplyData.phone" v-maska="'(##) #####-####'" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field mask="######-###" :disabled="disableInput" :label="'CEP'" v-model="supplyData.cep" :rules="[rules.required, rules.cep]" v-maska="'#####-###'"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Endereço'" v-model="supplyData.address" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Número'" v-model="supplyData.address_number" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-select
                                v-model="supplyData.state"
                                :items="listOfStates"
                                label="Estado"
                                clearable
                                :disabled="disableInput"
                                :rules="[rules.required]"
                                prepend-inner-icon="mdi-map-marker"
                            />
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Cidade'" v-model="supplyData.city" :rules="[rules.required]"></v-text-field>
                        </v-col>
                    </v-row>

                    <v-row v-if="supplyData.type == 'PJ'">
                        <v-col cols="12" lg="3" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'CNPJ do Fornecedor'" v-model="supplyData.cnpj" v-maska="'##.###.###/####-##'" :rules="[rules.required, rules.cnpj]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Nome do Fornecedor'" v-model="supplyData.name" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="3" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Razão Social do Fornecedor'" v-model="supplyData.social_name" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Telefone'" v-model="supplyData.phone" v-maska="'(##) #####-####'" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'CEP'" v-model="supplyData.cep" v-maska="'#####-###'" :rules="[rules.required, rules.cep]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="4" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Endereço'" v-model="supplyData.address" maxlength="255" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Número'" v-model="supplyData.address_number" maxlength="20" :rules="[rules.required]"></v-text-field>
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-select
                                v-model="supplyData.state"
                                :items="listOfStates"
                                label="Estado"
                                clearable
                                :disabled="disableInput"
                                :rules="[rules.required]"
                                prepend-inner-icon="mdi-map-marker"
                            />
                        </v-col>
                        <v-col cols="12" lg="2" class="qa-2">
                            <v-text-field :disabled="disableInput" :label="'Cidade'" v-model="supplyData.city" maxlength="100" :rules="[rules.required]"></v-text-field>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>

            <div v-if="formType != 'view'" class="d-flex justify-content-right mt-5" style="justify-content: right;">
                <v-btn 
                    @click="$router.push('/supplies')" 
                    variant="text" 
                    color="grey" 
                    prepend-icon="mdi-block"
                    class="mr-3"
                >
                    CANCELAR
                </v-btn>
                <v-btn 
                    type="submit"
                    variant="elevated" 
                    color="success"
                    prepend-icon="mdi-content-save"
                    :loading="loadingSave"
                >
                    {{ saveButtonLabel }} 
                </v-btn>
            </div>
        </v-form>

        <BrasilAPIConsultant 
            ref="BrasilAPIConsultant" 
            @cnpj-data="fillWithBrasilAPI"
        ></BrasilAPIConsultant>
    </v-card>
</template>

<script>
import { toast } from 'vue3-toastify'
import { mapActions } from 'vuex'
import BrasilAPIConsultant from '@/components/modals/BrasilAPIConsultant.vue'

export default {
    components: {
        BrasilAPIConsultant
    },

    props: {
        formType: {
            type: String,
            default: 'create'
        },

        saveButtonLabel: {
            type: String,
            default: 'CRIAR NOVO FORNECEDOR',
        },
    },

    data() {
        return {
            loadingSave: false,
            supplyTypeOptions: [
                { label: 'Pessoa Física (PF)', value: 'PF' },
                { label: 'Pessoa Jurídica (PJ)', value: 'PJ' },
            ],
            supplyData: this.defaultValuesSupply(),
            rules: this.validationRules(),
            listOfStates: [
                "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA",
                "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN",
                "RS", "RO", "RR", "SC", "SP", "SE", "TO"
            ],
            loadingEntity: false,
        }
    },

    methods: {
        ...mapActions('supply', [
            'create',
            'update',
            'getSupplyById',
        ]),

        async createOrUpdateSupply() {
            const form = this.$refs.supplyForm
            const { valid } = await form.validate()

            if (!valid) {
                return toast.error('Verifique os campos.')
            }

            this.loadingSave = true

            if (this.formType == 'create') {
                this.create(this.supplyData).then(() => {
                    toast.success('Fornecedor criado com sucesso!')
                    this.$router.push('/supplies')
                }).catch((error) => {
                    toast.error(error)
                }) 
            } else {
                this.update(this.supplyData).then(() => {
                    toast.success('Fornecedor atualizado com sucesso!')
                    this.$router.push('/supplies')
                }).catch((error) => {
                    toast.error(error)
                }) 
            }

            this.loadingSave = false
        },

        defaultValuesSupply() {
            return {
                type: 'PJ',
                name: '',
                social_name: '',
                cpf: '',
                cnpj: '',
                phone: '',
                cep: '',
                address: '',
                address_number: '',
                state: '',
                city: '',
            }
        },

        changedSupplyType() {
            let { type } = this.supplyData
            this.supplyData      = this.defaultValuesSupply()
            this.supplyData.type = type
        },

        validationRules() {
            return {
                required: value => !!value || 'Campo obrigatório',
                maxLength: max => value => !value || value.length <= max || `Máx. ${max} caracteres`,
                
                cpf: value => {
                    if (!value && this.type == 'PJ') return true
                    return /^\d{3}\.\d{3}\.\d{3}-\d{2}$/.test(value) || 'CPF inválido'
                },
                
                cnpj: value => {
                    if (!value && this.type == 'PF') return true
                    return /^\d{2}\.\d{3}\.\d{3}\/\d{4}-\d{2}$/.test(value) || 'CNPJ inválido'
                },
                
                cep: value => {
                    if (!value) return true
                    return /^\d{5}-\d{3}$/.test(value) || 'CEP inválido'
                },
                
                uf: value => { return !value || /^[A-Z]{2}$/.test(value) || 'UF deve ter 2 letras' },
            }
        },

        openBrasilAPIModal() {
            this.$refs.BrasilAPIConsultant.openModal()
        },

        fillWithBrasilAPI(cnpjData) {
            this.supplyData.social_name = cnpjData.nome_fantasia
            this.supplyData.name = cnpjData.razao_social
            this.supplyData.cnpj = cnpjData.cnpj 
            this.supplyData.address = cnpjData.logradouro
            this.supplyData.cep = cnpjData.cep
            this.supplyData.address_number = cnpjData.numero
            this.supplyData.state = cnpjData.uf
            this.supplyData.city = cnpjData.municipio
        }
    },

    computed: {
        disableInput() {
            return this.formType === 'view' || this.loadingEntity
        }
    },

    async created() {
        if (this.formType != 'create') {
            this.loadingEntity = true
            this.supplyData = await this.getSupplyById(this.$route.params.id)
            this.loadingEntity = false
        }
    },
}


</script>