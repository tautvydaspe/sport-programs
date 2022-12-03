<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="padding: 35px 0 35px 0" :key="rerender">
            <div class="container">
                <a class="" href="/"><div>
                    <div style="width: 3rem">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 25 25"
                            stroke-width="1.5"
                            stroke="white"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                            />
                        </svg>
                    </div>
                </div></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="menu-item" href="#" style="color: white">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu-item" href="#" style="color: white">Newsletter</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu-item" href="#" style="color: white">Programs</a>
                        </li>
                        <li class="nav-item">
                            <a class="menu-item" href="#" style="color: white">Contacts</a>
                        </li>
                        <li class="nav-item" v-if="showLogout === false">
                            <a class="menu-item" href="/login" style="color: white">Login</a>
                        </li>
                        <li class="nav-item" v-if="showLogout === false">
                            <a class="menu-item" href="/register" style="color: white">Register</a>
                        </li>
                        <li v-if="isAdmin" class="nav-item">
                            <a class="menu-item" href="/admin" style="color: white">Admin</a>
                        </li>
                        <li v-if="showLogout" class="nav-item">
                            <button class="menu-item" @click.prevent="logout">Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            isAdmin: false,
            showLogout: false,
            rerender: false,
        }
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then(() => {
                    this.showLogout = false
                    this.rerender = !this.rerender
                    alert('You have been logged off');
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                })
        },
        isLoggedIn() {
            axios.get('api/authenticated').then(() => {
                this.showLogout = true
            })
            .catch(error => {
                //console.log(error);
            })
        },
    },
    created() {
        this.isLoggedIn();
        axios.get('/api/user')
            .then( response => {
                this.user = response.data
                if (this.user.role === 0) {
                    this.isAdmin = true
                }
            })
            .catch( error => {
                //console.log( error );
            })
    },
}
</script>
