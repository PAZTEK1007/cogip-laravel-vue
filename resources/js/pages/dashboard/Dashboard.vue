<template>
</template>

<script>

export default {
    name: 'Dashboard',
    data() {
        return {
            user: {}
        };
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser() {
            axios.get('http://localhost:8000' + '/api/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
    
        logout() {
            axios.post('api/logout')
            .then(response => {
                console.log('Logout successful', response.data);
                this.$router.push({ name: 'Home' });
                this.isUserLoggedIn = false;
                this.$emit('logged-out');
                window.location.reload();
            })
            .catch(error => {
                console.error('Logout failed', error.response.data);
            });
        }
    },
};
</script>