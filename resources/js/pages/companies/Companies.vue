<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import TableComponent from '@/components/TableComponent.vue' // Import the TableComponent

const companies = ref([])

function getCompanies() {
    axios.get('api/companies')
        .then(response => {
          companies.value = response.data;
        })
        .catch(error => {
          console.error('Failed to get companies', error.response.data);
        });
}


onMounted(() => {
  getCompanies()
})

</script>

<template>
  <TableComponent title="Companies" th1="Name" th2="TVA" th3="Country" th4="Types" th5="Create At" :data="companies" />
</template>
