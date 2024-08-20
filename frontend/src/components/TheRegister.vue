<template>
  <div class="form_container">
    <h2>Register</h2>
    <form @submit.prevent="register">
      <input v-model="name" type="text" placeholder="Name" required />
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Password" required />
      <input v-model="password_confirmation" type="password" placeholder="Confirm Password" required />

      <p>Already have account? <router-link to="login" class="green">Login here</router-link></p>

      <button type="submit">Register</button>
      <p v-if="error">{{ error }}</p>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        error: null
      };
    },
    methods: {
      async register() {
        try {
          await this.$store.dispatch('register', {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation
          });
          this.$router.push('/');
        } catch (error) {
          this.error = 'Registration failed';
        }
      }
    }
  };
</script>

<style scoped>

</style>