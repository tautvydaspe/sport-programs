<template>
    <div>
        <Navbar></Navbar>
        <div class="login">
            <div class="login-main py-5 px-5">
                <h1 class="mb-4">REGISTER</h1>
                <input placeholder="Name" type="text" v-model="form.name" >
                <input class="mt-2" style="width: 300px;" placeholder="Last Name" type="text" v-model="form.last_name" >
                <input class="mt-2" placeholder="Main Goal" type="text" v-model="form.main_goal" >
                <input class="mt-2" placeholder="Phone Number" type="text" v-model="form.phone_number" >
                <input class="mt-2" placeholder="Email" type="email" v-model="form.email">
                <input class="mt-2" placeholder="Password" type="password" v-model="form.password" name="password">
                <input class="mt-2" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
                <button class="mt-2 login-button" @click.prevent="saveForm" type="submit">Register</button>
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
                last_name: '',
                main_goal: '',
                phone_number: '',
                email: '',
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
                this.$router.push({ name: "Login" })
            }).catch((error) =>{
                console.log(error.response.data);
            })
        }
    }
}
</script>
