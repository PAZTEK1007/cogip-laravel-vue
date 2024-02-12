<template>
  <div>
    <h1 class="title">Login</h1>
  </div>
  <div class="loginContainer">
    <form @submit.prevent="submitForm">
      <label for="email">Email</label>
      <input v-model="formData.email" type="email" name="email" id="email" placeholder="Email" required>

      <label for="password">Password</label>
      <input v-model="formData.password" type="password" name="password" id="password" placeholder="Password" required>

      <button type="submit">Sign in</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      formData: {
        email: '',
        password: ''
      }
    };
  },
  methods: {
    submitForm() {
      // Make an Axios POST request to your API endpoint for login
      axios.post('api/login', this.formData)
        .then(response => {
          // Handle the successful response
          console.log('Login successful', response.data);
          this.$router.push({ name: 'Home' });
          this.$emit('logged-in');
        })
        .catch(error => {
          console.error('Login failed', error.response.data);
        });
    }
  },
};
</script>
