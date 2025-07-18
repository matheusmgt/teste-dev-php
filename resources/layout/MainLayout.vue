<template>
    <div v-if="loadingUserData">
        <v-app-bar 
            color="white" 
            class="mb-10"
        >
            <img 
                :src="logoRevendaMais" 
                width="88" 
            />
            
            <v-app-bar-title>Cadastro de Fornecedores</v-app-bar-title>

            <v-spacer />

            <v-btn 
                variant="flat" 
                color="secondary" 
                @click="logout"
            >
                Sair
            </v-btn>
        </v-app-bar>
        <router-view  />
    </div>
    <div v-else class="spinner-overlay">
        <div class="spinner"></div>
    </div>
</template>

<script>
import logoRevendaMais from '@/assets/logo.png'
import { mapActions } from 'vuex'
import { toast } from 'vue3-toastify'

export default {
    data() {
        return {
            logoRevendaMais,
            loadingUserData: false,
        }
    },
    
    methods: {
        ...mapActions('user', [
            'getUser'
        ]),

        logout() {
            localStorage.removeItem('token')
            this.$router.push('/login')
        },
    },

    created() {
        this.getUser().then((success) => {
            this.loadingUserData = true
        })
        .catch((error) => {
            this.$router.push('/login')
            toast.error('Autentique-se primeiro!')
        })
    }
}
</script>

<style scoped>
.spinner-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(255, 255, 255, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.spinner {
  width: 60px;
  height: 60px;
  border: 6px solid #ccc;
  border-top-color: #3498db; /* cor do spinner */
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}
</style>