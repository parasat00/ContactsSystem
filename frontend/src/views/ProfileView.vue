<script>
export default {
  computed: {
    user() {
      return this.$store.state.user;
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
      this.$router.push('/login');
    }
  },
  beforeCreate() {
    if (!this.$store.getters.isAuthenticated) {
      this.$router.push('/login');
    }
  }
};
</script>

<template>
  <div>
    <h2>Profile</h2>
    <p>Welcome, {{ user.name }}!</p>
    <button @click="logout">Logout</button>
  </div>
</template>