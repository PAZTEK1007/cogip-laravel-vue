<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios' // Import axios library

const user = ref({})
const isUserLoggedIn = ref(null)

function getUser() {
  axios.get('api/user')
        .then(response => {
          user.value = response.data;
          isUserLoggedIn.value = true;
        })
        .catch(error => {
          console.error('Failed to get user', error.response.data);
        });
}

function logout() {
  axios.post('api/logout')
        .then(response => {
          console.log('Logout successful', response.data);
          $router.push({ name: 'Home' });
          isUserLoggedIn.value = false;
          $emit('logged-out');
          window.location.reload();
        })
        .catch(error => {
          console.error('Logout failed', error.response.data);
        });
}

onMounted(() => {
  getUser()
})

</script>

<template>
  <header>
    <div class="navContainer">
      <nav>
        <h1 class="brand">COGIP</h1>
        <ul class='navMenu' v-if="isUserLoggedIn">
          <li><router-link :to="{ name: 'Home' }" class="navItems">Home</router-link></li>
          <li><router-link :to="{ name: 'Companies' }" class="navItems">Companies</router-link></li>
          <li><router-link :to="{ name: 'Contacts' }" class="navItems">Contacts</router-link></li>
          <li><router-link :to="{ name: 'Invoices' }" class="navItems">Invoices</router-link></li>
        </ul>
      </nav>
      <div class="log" v-if="!isUserLoggedIn">
        <router-link :to="{ name: 'Register' }" id="rgstrBtn">Sign up</router-link>
        <router-link :to="{ name: 'Login' }" id="loginBtn">Login</router-link>
      </div>
      <div class="log" v-if="isUserLoggedIn">
        <router-link :to="{ name: 'Dashboard' }" id="dashBtn">
          <img src="/../img/icon-dashboard.png" alt="dash" id="dashImg">
        </router-link>
        <p id="logMsg">Hello, {{ user.first_name }}</p>
        <button id="logoutBtn"@click="logout">Logout</button>
      </div>
    </div>
  </header>
</template>
