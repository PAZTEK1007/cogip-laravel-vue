<template>
<div class="homeContainer">
  <div class="firstSection">
    <h1 class="titleHome" v-if="isUserLoggedIn">MANAGE YOUR CUSTOMERS AND INVOICES EASLY</h1>
    <h1 class="titleHome" v-else>WELCOME TO COGIP</h1>
    <picture>
      <source srcset="/../img/homeLogo.png" media="(min-width: 768px)">
      <img src="/../img/homeLogo.png" alt="Invoice" class="homeImg">
    </picture>
  </div>
  <div id="formDesign"></div>
  <div class="tablesContainer" v-if="isUserLoggedIn">
    <div class="invoicesContainer">
      <h2 class="titleTable">Last Invoices</h2>
      <table>
        <thead>
          <th>Invoice number</th>
          <th>Dates due</th>
          <th>Company</th>
          <th>Create At</th>
        </thead>
        <tbody>
          <tr v-for="invoice in invoices" :key="invoice.id">
            <td class="td1">{{ invoice.ref }}</td>
            <td class="td2">{{ invoice.updated_at }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: invoice.company_id } }">
            <td class="td1">{{ getCompanyName(invoice.company_id) }}</td>
            </router-link>
            <td class="td1">{{ invoice.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <img src="/../img/imgCalpin.png" alt="Invoice" class="calpin">
    <div class="contactContainer">
      <h2 class="titleTable">Last Contacts</h2>
      <table>
        <thead>
          <th>Name</th>
          <th>Phone</th>
          <th>Mail</th>
          <th>Company</th>
          <th>Create At</th>
        </thead>
        <tbody>
          <tr v-for="contact in contacts" :key="contact.id">
            <router-link class="link" :to="{ name: 'Contact', params: { id: contact.id } }">
            <td class="td1">{{ contact.name }}</td>
            </router-link>
            <td class="td2">{{ contact.phone}}</td>
            <td class="td1">{{ contact.email }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: contact.company_id } }">
            <td class="td1">{{ getCompanyName(contact.company_id) }}</td>
            </router-link>
            <td class="td1">{{ contact.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <img src="/../img/ampoule.png" alt="ampoule" class="ampoule">
    <div class="companiesContainer">
      <h2 class="titleTable">Last Companies</h2>
      <table>
        <thead>
          <th>Name</th>
          <th>TVA</th>
          <th>Country</th>
          <th>Type</th>
          <th>Create At</th>
        </thead>
        <tbody>
          <tr v-for="company in companies" :key="company.id">
            <router-link class="link" :to="{ name: 'Company', params: { id: company.id } }">
            <td class="td1">{{ company.name }}</td>
            </router-link>
            <td class="td2">{{ company.tva}}</td>
            <td class="td1">{{ company.country}}</td>
            <td class="td1">{{ getTypeName(company.type_id) }}</td>
            <td class="td1">{{ company.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="welcomeMessage" v-else>
    <h2 class="title">WHAT IS COGIP ?</h2>
    <div id="rectangle"></div>
    <p class="textHome">Cogip is a simple and efficient tool to manage your customers and invoices. You can easily create, edit and delete your customers and invoices. You can also see the last 5 invoices, contacts and companies created. You can also see the details of each invoice, contact and company. You can also see the details of each invoice, contact and company.</p>
    <div class="btnContainer">
      <router-link :to="{ name: 'Register' }" class="link">Sign</router-link>
      <router-link :to="{ name: 'Login' }" class="link">Login</router-link>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      companies: [],
      contacts: [],
      invoices: [],
      isUserLoggedIn: null,
    };
  },
  created() {
    axios.all([
      axios.get('/api/five-last/contacts'),
      axios.get('/api/five-last/companies'),
      axios.get('/api/five-last/invoices'),
    ])
      .then(axios.spread((contactsResponse, companiesResponse, invoicesResponse) => {
        this.contacts = contactsResponse.data;
        this.companies = companiesResponse.data;
        this.invoices = invoicesResponse.data;
      }))
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    getCompanyName(companyId) {
      const company = this.companies.find(company => company.id === companyId);
      return company ? company.name : 'Unknown Company';
    },
    getTypeName(typeId) {
      return typeId === 1 ? 'Supplier' : 'Client';
    },

    getUser() {
      axios.get('api/user')
        .then(response => {
          this.isUserLoggedIn = true;
        })
        .catch(error => {
          this.isUserLoggedIn = false;
        });
    },
  },
  mounted() {
    console.log('Component mounted.');
    this.getUser();
  },
};
</script>