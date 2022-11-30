<template>
    <div>
        <Navbar></Navbar>
        <table class="m-5">
            <thead>
                <tr>
                    <th>Vardas</th>
                    <th>Pavarde</th>
                    <th>Siekiamas tikslas</th>
                    <th>El. pastas</th>
                    <th>Telefono numeris</th>
                    <th>Trinti</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="vartotojas in users">
                    <td>{{ vartotojas.name }}</td>
                    <td>{{ vartotojas.last_name }}</td>
                    <td>{{ vartotojas.main_goal }}</td>
                    <td>{{ vartotojas.email }}</td>
                    <td>{{ vartotojas.phone_number }}</td>
                    <td><button class="btn btn-danger">Trinti</button></td>
                </tr>
            </tbody>
        </table>

        <button @click.prevent="logout">Logout</button>
    </div>
</template>

<script>
import Navbar from './Navbar';

export default {
    components: {
        Navbar
    },
    data: function () {
        return {
            user: null,
            users: [],
            show: false,
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then( () => {
                    this.$router.push({ name: "Home" })
                })
                .catch( error => {
                    alert( error );
                })
        },
    },
    mounted() {
        axios.get('/api/user')
            .then( response => {
                this.user = response.data
                console.log('USERIS')
                console.log(this.user)
                if (this.user.role === 1) {
                    this.$router.push({ name: "Home" })
                } else {
                    this.show = true;
                    axios.get('/api/users')
                        .then(response => {
                            this.users = response.data
                            console.log('USERIAI')
                            console.log(this.users)
                        })
                }
            })
            .catch( error => {
                alert( error );
            })
    }
}
</script>
<style>
td, th {
    padding: 5px;
    border: 1px solid gray;
    color: white;
}
</style>
