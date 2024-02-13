<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import TableComponent from '@/components/TableComponent.vue' // Import the TableComponent

const invoices = ref([])

function getInvoices() {
    axios.get('api/invoices')
        .then(response => {
          invoices.value = response.data;
        })
        .catch(error => {
          console.error('Failed to get invoices', error.response.data);
        });
}

onMounted(() => {
  getInvoices()
})

</script>

<template>
  <TableComponent title="Invoices" th1="Ref" th2="Date Dues" th3="Company" th4="Create At" :data="invoices" />
</template>
