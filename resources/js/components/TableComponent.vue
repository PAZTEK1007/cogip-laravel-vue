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

const companiesTable = ref(false);
const contactsTable = ref(false);
const invoicesTable = ref(false);
const companyNames = ref({});
const typeNames = ref({});


async function getType(typeId) {
  try {
    if (!typeNames.value[typeId]) {
      console.log(typeId);
      const typeResponse = await axios.get(`/api/types/${typeId}`);
      typeNames.value[typeId] = typeResponse.data.name;
    }
  } catch (error) {
    console.error(error);
  }
}

async function getCompanyInfo(companyId) {
  try {
    if (!companyNames.value[companyId]) {
      const companyResponse = await axios.get(`/api/companies/${companyId}`);
      companyNames.value[companyId] = companyResponse.data.name;
    }
  } catch (error) {
    console.error(error);
  }
}

function isCompanies() {
  companiesTable.value = props.title === "Companies";
}

function isContacts() {
  contactsTable.value = props.title === "Contacts";
}

function isInvoices() {
  invoicesTable.value = props.title === "Invoices";
}

onMounted(async () => {
  for (let item of props.data) {
    await getCompanyInfo(item.company_id);
    await getType(item.type_id);
  }
  isCompanies();
  isContacts();
  isInvoices();
});
</script>

<template>
  <h1 class="title">All {{ title }}</h1>
  <div id="rectangle"></div>

  <div class="container" v-if="companiesTable && data.length > 0">
    <table>
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
          <td id="typeId">{{ typeNames[item.type_id] }} </td>
          <td class="td1">{{ item.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container" v-if="contactsTable && data.length > 0">
    <table>
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
            <td class="td1">{{ companyNames[item.company_id] }}</td>
          </router-link>
          <td class="td1">{{ item.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="container" v-if="invoicesTable && data.length > 0">
    <table>
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
            <td class="td1">{{ companyNames[item.company_id] }}</td>
          </router-link>
          <td class="td2">{{ item.created_at }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
