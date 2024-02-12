import './bootstrap';
import { createApp } from 'vue';
import router from './routes/router';

const app = createApp({});
// Components
import Navbar from './components/Navbar.vue';
import TableComponent from './components/TableComponent.vue';
app.component('navbar', Navbar);
app.component('table-component', TableComponent);


// Pages
import Home from './pages/Home.vue';
import Login from './pages/Login.vue';
import Register from './pages/Register.vue';
import Companies from './pages/companies/Companies.vue';
import Company from './pages/companies/Company.vue';
import Invoices from './pages/invoices/Invoices.vue';
import Contacts from './pages/contacts/Contacts.vue';
import Contact from './pages/contacts/Contact.vue';
import Dashboard from './pages/dashboard/Dashboard.vue';


app.component('login', Login);
app.component('register', Register);
app.component('home', Home);
app.component('companies', Companies);
app.component('company', Company);
app.component('invoices', Invoices);
app.component('contacts', Contacts);
app.component('contact', Contact);
app.component('dashboard', Dashboard);
app.use(router);
app.mount('#app');
