<template>
  <div class="contactHeaderInfo">
    <h1 class="titleContact">{{ contact.name }}</h1>
    <div id="rectangle"></div>
  </div>
  <div class="contactInfoContainer">
    <ul class="contactInfoList">
      <li><strong>Contact:</strong> {{ contact.name }}</li>
      <li><strong>Phone:</strong> {{ contact.phone }}</li>
      <li><strong>Mail:</strong> {{ contact.email }}</li>
      <li><strong>Company:</strong> {{ getCompanyName(contact.company_id) }}</li>
    </ul>
    <img :src="contact.picture" alt="Profile" class="contactPicture">
  </div>
</template>

<script>

export default {
  data() {
    return {
      contact: [],
      companies: [],
    };
  },
  created() {
    const contactId = this.$route.params.id;
    const companyId = this.contact.company_id;
   axios.all([
      axios.get(`/api/contacts/${contactId}`),
      axios.get(`/api/companies`),
    ])
      .then(axios.spread((contactResponse, companiesResponse) => {
        this.contact = contactResponse.data;
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