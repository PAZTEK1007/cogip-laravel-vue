<template>
  <div>
    <h1 class="title">All Invoices</h1>
    <div id="rectangle">
    </div>
    <div class="container">
      <table>
        <thead>
          <th>Invoice number</th>
          <th>Dues dates</th>
          <th>Company</th>
          <th>Created at</th>
        </thead>
        <tbody>
          <tr v-for="invoice in invoices" :key="invoice.id">
            <td class="td1">{{ invoice.ref }}</td>
            <td class="td2">{{ invoice.updated_at }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: invoice.company_id } }">
            <td class="td2">{{ getCompanyName(invoice.company_id) }}</td>
            </router-link>
            <td class="td1">{{ invoice.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      invoices: [],
      companies: [],
    };
  },
  created() {
    // Fetch both invoices and companies
    axios.all([
      axios.get('/api/invoices'),
      axios.get('/api/companies'),
    ])
      .then(axios.spread((invoicesResponse, companiesResponse) => {
        this.invoices = invoicesResponse.data;
        this.companies = companiesResponse.data;
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
  },
  mounted() {
    console.log('Component mounted.');
  },
};
</script>