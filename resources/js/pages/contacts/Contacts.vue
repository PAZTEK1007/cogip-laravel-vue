<template>
  <div>
    <h1 class="title">All Contacts</h1>
    <div id="rectangle">
    </div>
    <div class="container">
      <table>
        <thead>
          <th>Name</th>
          <th>Phone</th>
          <th>Mail</th>
          <th>Company</th>
          <th>Created at</th>
        </thead>
        <tbody>
          <tr v-for="contact in contacts" :key="contacts.id">
            <router-link class="link" :to="{ name: 'Contact', params: { id: contact.id } }">
            <td class="td1">{{ contact.name }}</td>
            </router-link>
            <td class="td2">{{ contact.phone }}</td>
            <td class="td1">{{ contact.email }}</td>
            <router-link class="link" :to="{ name: 'Company', params: { id: contact.company_id } }">
            <td class="td2">{{ getCompanyName(contact.company_id) }}</td>
            </router-link>
            <td class="td1">{{ contact.created_at }}</td>
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
      companies: [],
      contacts: [],
    };
  },
  created() {
    axios.all([
      axios.get('/api/contacts'),
      axios.get('/api/companies'),
    ])
      .then(axios.spread((contactsResponse, companiesResponse) => {
        this.contacts = contactsResponse.data;
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