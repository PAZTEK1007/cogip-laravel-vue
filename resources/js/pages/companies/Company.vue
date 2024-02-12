<template>
  <div>
    <h1 class="title">{{ company.name }}</h1>
    <div id="rectangle"></div>
    <div class="companyContainer">
      <div class="companyInfo">
        <ul>
          <li><strong>Name:</strong> {{ company.name }}</li>
          <li><strong>TVA:</strong> {{ company.tva }}</li>
          <li><strong>Country:</strong> {{ company.country }}</li>
          <li><strong>Type:</strong> {{ getTypeName(company.type_id) }}</li>
        </ul>
      </div>
      <h2 class="titleTable">Contact people</h2>
      <div class="contactContainerList">
        <li v-for="contact in contacts" :key="contact.id" class="contactList">
          <img :src="contact.picture" alt="Profile" class="contactImg">
          <router-link :to="{ name: 'Contact', params: { id: contact.id } }">
             {{ contact.name }} 
          </router-link>
        </li>
      </div>
      <h2 class="titleTable">Last Invoices</h2>
      <div class="invoicesContainerFromCompany">
        <table>
          <thead>
            <tr>
              <th>Invoice number</th>
              <th>Dates due</th>
              <th>Company</th>
              <th>Create At</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="invoice in invoices" :key="invoice.id">
              <td class="td1">{{ invoice.ref }}</td>
              <td class="td2">{{ invoice.updated_at }}</td>
              <td class="td1">
                <router-link :to="{ name: 'Company', params: { id: invoice.company_id } }">
                  {{ getCompanyName(invoice.company_id) }}
                </router-link>
              </td>
              <td class="td1">{{ invoice.created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Company',
  data() {
    return {
      companies: [],
      company: {},
      invoices: [],
      contacts: [],
    };
  },
  created() {
    const companyId = this.$route.params.id;
    axios.all([
      axios.get(`/api/companies/${companyId}`),
      axios.get(`/api/companies`),
      axios.get(`/api/five-last/invoices/${companyId}`),
      axios.get(`/api/contacts/company/${companyId}`),
    ])
      .then(axios.spread((companyResponse, companiesResponse, invoicesResponse, contactsResponse) => {
        this.company = companyResponse.data;
        this.companies = companiesResponse.data;
        this.invoices = invoicesResponse.data;
        this.contacts = contactsResponse.data;
      }))
      .catch(error => {
        console.error(error);
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
  },
  mounted() {
    console.log('Component mounted.');
  },
};
</script>

