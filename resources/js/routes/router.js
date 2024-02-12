import { createRouter, createWebHistory } from "vue-router";
// Pages
import Home from "../pages/Home.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Companies from "../pages/companies/Companies.vue";
import Company from "../pages/companies/Company.vue";
import Invoices from "../pages/invoices/Invoices.vue";
import Contacts from "../pages/contacts/Contacts.vue";
import Contact from "../pages/contacts/Contact.vue";
import Dashboard from "../pages/dashboard/Dashboard.vue";

const routes = [
    
    {
        path: "/",
        name: "Home",
        component: Home
    },
    {
        path: "/signup",
        name: "Register",
        component: Register
    },
    {
        path: "/login",
        name: "Login",
        component: Login
    },
    {
        path: "/companies",
        name: "Companies",
        component: Companies
    },
    {
        path: '/companies/:id',
        name: 'Company',
        component: Company
    
    },
    {
        path: '/invoices',
        name: 'Invoices',
        component: Invoices
    },
    {
        path: '/contacts',
        name: 'Contacts',
        component: Contacts
    },
    {
        path: '/contacts/:id',
        name: 'Contact',
        component: Contact
    },

    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;