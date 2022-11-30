<template>
    <div>
        <Navbar></Navbar>
        <div class="login">
            <div class="login-main py-5 px-5">
                <h1 class="mb-4">LOGIN</h1>
                <form action="">
                    <input class="input-item" type="text" placeholder="Name" v-model="form.name" />
                    <input class="input-item" style="width: 300px;" type="email" placeholder="E-mail" v-model="form.email" />
                    <input class="input-item mb-3" type="password" placeholder="Password" v-model="form.password" name="password" />
                    <button class="login-button" @click.prevent="loginUser" type="submit">Login</button>
                </form>
            </div>
        </div>
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
            form:{
                name: '',
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods:{
        loginUser(){
            axios.post('/api/login', this.form).then(() =>{
                this.$router.push({ name: "Home"});
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
