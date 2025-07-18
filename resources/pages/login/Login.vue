<template>
  <v-container class="d-flex justify-center align-center" style="height: 100vh;">
      <login-form></login-form>
  </v-container>
</template>

<script>
import LoginForm from '@/components/login/LoginForm.vue'

export default {
   components: {
      LoginForm
   }
}
</script>