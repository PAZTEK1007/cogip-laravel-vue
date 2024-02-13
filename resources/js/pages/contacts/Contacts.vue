<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import TableComponent from '@/components/TableComponent.vue' // Import the TableComponent

const contacts = ref([])

function getContacts() {
    axios.get('api/contacts')
        .then(response => {
          contacts.value = response.data;
        })
        .catch(error => {
          console.error('Failed to get companies', error.response.data);
        });
}

onMounted(() => {
  getContacts()
})

</script>

<template>
  <TableComponent title="Contacts" th1="Name" th2="Phone" th3="Email" th4="Company" th5="Create At" :data="contacts" />
</template>
