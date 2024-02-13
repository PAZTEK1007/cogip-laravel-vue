<script setup>
import axios from 'axios';
import { defineProps, onMounted, ref } from 'vue';

const props = defineProps({
    title: String,
    th1: String,
    th2: String,
    th3: String,
    th4: String,
    th5: String,
    data: Array,
});
const typeName = ref('')
const companyName = ref('')
const companiesTable = ref(null);
const contactsTable = ref(null);
const invoicesTable = ref(null);
const typeId = ref(null);
const companyId = ref();

async function isCompanies() {
  if (props.title === "Companies" ) {
    companiesTable.value = true;
    await axios.get(`api/types/${typeId}`)
      .then(response => {
        typeName.value = response.data.name;

      })
      .catch(error => {
        console.error('Failed to get types' + error.response.data);
      });
  }
}
function isContacts() {
  if (props.title === "Contacts" ) {
    contactsTable.value = true;
  }
}
function isInvoices() {
  if (props.title === "Invoices" ) {
    invoicesTable.value = true;
  }
}

onMounted(() => {
  isCompanies()
  isContacts()
  isInvoices()
})

</script>

<template>
  <h1 class="title">All {{ title }}</h1>
  <div id="rectangle"></div>
    <div class="container" v-if="companiesTable">
      <table v-if="data.length > 0">
        <thead>
          <th>{{ th1 }}</th>
          <th>{{ th2 }}</th>
          <th>{{ th3 }}</th>
          <th>{{ th4 }}</th>
          <th>{{ th5 }}</th>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id">
            <router-link class="link" :to="{ name: 'Company', params: { id: item.id } }">
              <td class="td1">{{ item.name }}</td>
            </router-link>
            <td class="td2">{{ item.tva }}</td>
            <td class="td1">{{ item.country }}</td>
            <td id="typeId" class="td1">{{ item.type_id }}</td>
            <td class="td1">{{ item.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="container" v-if="contactsTable">
      <table v-if="data.length > 0">
        <thead>
          <th>{{ th1 }}</th>
          <th>{{ th2 }}</th>
          <th>{{ th3 }}</th>
          <th>{{ th4 }}</th>
          <th>{{ th5 }}</th>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id">
            <router-link class="link" :to="{ name: 'Contact', params: { id: item.id } }">
              <td class="td1">{{ item.name }}</td>
            </router-link>
            <td class="td2">{{ item.phone }}</td>
            <td class="td1">{{ item.email }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: item.company_id } }">
            <td class="td1">{{ item.company_id}}</td>
            </router-link>
            <td class="td1">{{ item.created_at }}</td>
          </tr>
       
        </tbody>
      </table>
    </div>

    <div class="container" v-if="invoicesTable">
      <table v-if="data.length > 0">
        <thead>
          <th>{{ th1 }}</th>
          <th>{{ th2 }}</th>
          <th>{{ th3 }}</th>
          <th>{{ th4 }}</th>
        </thead>
        <tbody>
          <tr v-for="item in data" :key="item.id">
            <td class="td1">{{ item.ref }}</td>
            <td class="td2">{{ item.updated_at }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: item.company_id } }">
              <td class="td1">{{ item.company_id }}</td>
            </router-link>
            <td class="td2">{{ item.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
</template>
