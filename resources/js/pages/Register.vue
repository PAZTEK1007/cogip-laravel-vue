<template>
  <div>
    <h1 class="title">Register</h1>
  </div>
  <div class="registerContainer">
    <form @submit.prevent="submitForm">
      <label for="first_name">First Name</label>
      <input v-model="formData.first_name" type="text" name="first_name" id="first_name" placeholder="First Name" required>

      <label for="last_name">Last Name</label>
      <input v-model="formData.last_name" type="text" name="last_name" id="last_name" placeholder="Last Name" required>

      <label for="email">Email</label>
      <input v-model="formData.email" type="email" name="email" id="email" placeholder="Email" required>

      <label for="password">Password</label>
      <input v-model="formData.password" type="password" name="password" id="password" placeholder="Password" required>
      
      <label for="password_confirmation">Confirm Password</label>
      <input v-model="formData.password_confirmation" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>

      <button type="submit">Sign in</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      formData: {
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    };
  },
  methods: {
    submitForm() {
      // Make an Axios POST request to your API endpoint for login
      axios.post('api/signup', this.formData)
        .then(response => {
          // Handle the successful response
          console.log('Register successful', response.data);
          this.$router.push({ name: 'Login' });
        })
        .catch(error => {
          console.error('Register failed', error.response.data);
        });
    }
  },
};
</script>
