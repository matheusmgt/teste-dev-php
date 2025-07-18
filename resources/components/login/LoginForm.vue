<template>
    <v-card elevation="10" width="400">
      <div class="d-flex justify-center">
         <img 
            :src="logoRevendaMais" 
            width="128" 
         />
      </div>
      <v-card-text>
        <v-form v-model="valid" ref="form">
          <v-text-field
            v-model="email"
            label="Email"
            prepend-inner-icon="mdi-email"
          ></v-text-field>

          <v-text-field
            v-model="password"
            label="Senha"
            type="password"
            prepend-inner-icon="mdi-lock"
          ></v-text-field>
        </v-form>
      </v-card-text>

      <v-card-actions class="justify-end">
         <v-btn 
            color="primary" 
            variant="elevated"
            append-icon="mdi-arrow-right"
            @click="tryToLogin"
            :loading="loading"
         >
            Entrar
         </v-btn>
      </v-card-actions>
    </v-card>
</template>

<script>
import logoRevendaMais from '@/assets/logo.png'
import { mapActions } from 'vuex'
import { toast } from 'vue3-toastify'
import axios from 'axios'

export default {
   data() {
      return {
         logoRevendaMais,
         email: '',
         password: '',
         loading: false,
      }
   },

   methods: {
      ...mapActions('user', [
         'login'
      ]),

      tryToLogin() {
         if (!this.email || !this.password) {
            return toast.error('Por gentileza, informe seus dados!')
         }

         this.loading = true

         this.login({
            email: this.email,
            password: this.password
         }).then((token) => {
            localStorage.setItem('token', token)
            toast.success('Logado com sucesso!')

            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

            // Redirecionando para tela de fornecedores
            setTimeout(() => {
               this.$router.push('/supplies')
            }, 100)
         }).catch((error) => {
            toast.error('Email/senha inválido.')
         }).finally(() => {
            this.loading = false
         })
      },
   }
}
</script>