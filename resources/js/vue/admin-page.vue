<template>
    <div>
        <Navbar></Navbar>
        <div class="container" :key="rerender">
            <h2 class="text-white mb-3 mt-4">Vartotojai</h2>
            <table>
                <thead>
                <tr>
                    <th>Vardas</th>
                    <th>Pavarde</th>
                    <th>Siekiamas tikslas</th>
                    <th>El. pastas</th>
                    <th>Telefono numeris</th>
                    <th>Trinti</th>
                    <th>Redaguoti</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(vartotojas, index) in users">
                    <td>{{ vartotojas.name }}</td>
                    <td>{{ vartotojas.last_name }}</td>
                    <td>{{ vartotojas.main_goal }}</td>
                    <td>{{ vartotojas.email }}</td>
                    <td>{{ vartotojas.phone_number }}</td>
                    <td><button class="w-100" style="background-color: red;" @click="deleteUser(vartotojas.id)">Trinti</button></td>
                    <td>
                        <button v-if="vartotojas.showEditForm === false" class="w-100" style="background-color: #4a8699" @click="openEditForm(index)">Redaguoti</button>
                        <form v-if="vartotojas.showEditForm" class="mb-5 mt-1" style="color: white;" @submit.prevent="updateUser($event,vartotojas.id)">
                            <input type="text" name="name" :value=vartotojas.name /><br>
                            <input type="text" name="last_name" :value=vartotojas.last_name /><br>
                            <input type="text" name="main_goal" :value=vartotojas.main_goal /><br>
                            <input type="text" name="phone_number" :value=vartotojas.phone_number /><br>
                            <input type="text" name="email" :value=vartotojas.email /><br>
                            <button style="width: 100%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Redaguoti</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <h4 class="text-white mt-5 mb-2">Pridekite vartotoja</h4>
            <form class="mb-5" style="color: white;" @submit.prevent="addUser($event)">
                <input class="w-25 mb-1" type="text" name="name" placeholder="Vardas" /><br>
                <input class="w-25 mb-1" type="text" name="last_name" placeholder="Pavarde" /><br>
                <input class="w-25 mb-1" type="text" name="main_goal" placeholder="Pagrindinis tikslas" /><br>
                <input class="w-25 mb-1" type="text" name="phone_number" placeholder="Telefono numeris" /><br>
                <input class="w-25 mb-1" type="text" name="email" placeholder="El. pastas" /><br>
                <input class="w-25 mb-1" type="password" name="password" placeholder="Slaptazodis" /><br>
                <input class="w-25 mb-1" placeholder="Pakartokite slaptazodi" type="password" name="password_confirmation"><br>
                <button style="background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Įterpti</button>
            </form>

            <h2 class="text-white mb-3 mt-5">Treneriai</h2>
            <table>
                <thead>
                <tr>
                    <th>Vardas</th>
                    <th>Pavarde</th>
                    <th>Specializacija</th>
                    <th>Issilavinimas</th>
                    <th>Trinti</th>
                    <th>Redaguoti</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(treneris, index) in trainers">
                    <td>{{ treneris.vardas }}</td>
                    <td>{{ treneris.pavarde }}</td>
                    <td>{{ treneris.specializacija }}</td>
                    <td>{{ treneris.issilavinimas }}</td>
                    <td><button class="w-100" style="background-color: red;" @click="deleteTrainer(treneris.id)">Trinti</button></td>
                    <td>
                        <button v-if="treneris.showEditForm === false" class="w-100" style="background-color: #4a8699" @click="openTrainerEditForm(index)">Redaguoti</button>
                        <form v-if="treneris.showEditForm" class="mb-5 mt-1" style="color: white;" @submit.prevent="updateTrainer($event,treneris.id)">
                            <input type="text" name="vardas" :value=treneris.vardas /><br>
                            <input type="text" name="pavarde" :value=treneris.pavarde /><br>
                            <input type="text" name="specializacija" :value=treneris.specializacija /><br>
                            <input type="text" name="issilavinimas" :value=treneris.issilavinimas /><br>
                            <button style="width: 100%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Redaguoti</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <h4 class="text-white mt-5 mb-2">Pridekite treneri</h4>
            <form class="mb-5" style="color: white;" @submit.prevent="addTrainer($event)">
                <input class="w-25 mb-1" type="text" name="vardas" placeholder="Vardas" /><br>
                <input class="w-25 mb-1" type="text" name="pavarde" placeholder="Pavarde" /><br>
                <input class="w-25 mb-1" type="text" name="specializacija" placeholder="Specializacija" /><br>
                <input class="w-25 mb-1" type="text" name="issilavinimas" placeholder="Issilavinimas" /><br>
                <button style="background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Įterpti</button>
            </form>

            <h2 class="text-white mb-3 mt-5">Galimi tikslai</h2>
            <table>
                <thead>
                <tr>
                    <th>Tikslas</th>
                    <th>Trinti</th>
                    <th>Redaguoti</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(goal, index) in goals">
                    <td>{{ goal.tikslas }}</td>
                    <td><button class="w-100" style="background-color: red;" @click="deleteGoal(goal.id)">Trinti</button></td>
                    <td>
                        <button v-if="goal.showEditForm === false" class="w-100" style="background-color: #4a8699" @click="openGoalEditForm(index)">Redaguoti</button>
                        <form v-if="goal.showEditForm" class="mb-5 mt-1" style="color: white;" @submit.prevent="updateGoal($event,goal.id)">
                            <input type="text" name="tikslas" :value=goal.tikslas /><br>
                            <button style="width: 100%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Redaguoti</button>
                        </form>
                    </td>
                </tr>
                </tbody>
            </table>

            <h4 class="text-white mt-5 mb-2">Pridekite tiksla</h4>
            <form class="mb-5" style="color: white;" @submit.prevent="addGoal($event)">
                <input class="w-25 mb-1" type="text" name="tikslas" placeholder="Tikslas" /><br>
                <button style="background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Įterpti</button>
            </form>
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
            user: null,
            users: [],
            trainers: [],
            goals: [],
            show: false,
            rerender: false,
            vartotojas: {
                name: "",
                last_name: "",
                main_goal: "",
                phone_number: "",
                password : 0,
                password_confirmation : 0,
                email : "",
            },
            treneris: {
                vardas: "",
                pavarde: "",
                specializacija: "",
                issilavinimas: "",
            },
            tikslas: {
                tikslas: "",
            },
        }
    },
    methods: {
        getUserData() {
            axios.get('/api/user')
                .then( response => {
                    this.user = response.data
                    //console.log('USERIS')
                   // console.log(this.user)
                    if (this.user.role === 1) {
                        this.$router.push({ name: "Home" })
                    } else {
                        this.show = true;
                        axios.get('/api/users')
                            .then(response => {
                                this.users = response.data
                                this.users.forEach(user => {
                                    user.showEditForm = false
                                })
                            })
                    }
                })
                .catch( error => {
                    alert( error );
                })
        },
        getTrainerData() {
            axios.get('/api/user')
                .then( response => {
                    this.user = response.data
                    console.log('USERIS')
                    console.log(this.user)
                    if (this.user.role === 1) {
                        this.$router.push({ name: "Home" })
                    } else {
                        this.show = true;
                        axios.get('/api/trainers')
                            .then(response => {
                                this.trainers = response.data
                                this.trainers.forEach(treneris => {
                                    treneris.showEditForm = false
                                })
                                console.log('TRENERIAI')
                                console.log(this.trainers)
                            })
                    }
                })
                .catch( error => {
                    alert( error );
                })
        },
        getGoalData() {
            axios.get('/api/user')
                .then( response => {
                    this.user = response.data
                    console.log('USERIS')
                    console.log(this.user)
                    if (this.user.role === 1) {
                        this.$router.push({ name: "Home" })
                    } else {
                        this.show = true;
                        axios.get('/api/pagrindiniai_tikslai')
                            .then(response => {
                                this.goals = response.data
                                this.goals.forEach(tikslas => {
                                    tikslas.showEditForm = false
                                })
                                console.log('TRENERIAI')
                                console.log(this.goals)
                            })
                    }
                })
                .catch( error => {
                    alert( error );
                })
        },
        addUser (submitEvent) {
            if (submitEvent.target.elements.name.value === '' || submitEvent.target.elements.last_name.value === '' || submitEvent.target.elements.main_goal.value === '' || submitEvent.target.elements.phone_number.value === '' || submitEvent.target.elements.email.value === '' || submitEvent.target.elements.password.value === '' || submitEvent.target.elements.password_confirmation.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                name: submitEvent.target.elements.name.value,
                last_name: submitEvent.target.elements.last_name.value,
                main_goal: submitEvent.target.elements.main_goal.value,
                phone_number: submitEvent.target.elements.phone_number.value,
                email : submitEvent.target.elements.email.value,
                password : submitEvent.target.elements.password.value,
                password_confirmation : submitEvent.target.elements.password_confirmation.value,
            }

            axios.post('/api/user/store', data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getUserData(this.id)
        },
        deleteUser(id) {
            axios.delete('/api/user/delete/' + id)
                .then(response => {
                    if (response.status === 200) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getUserData();
        },
        openEditForm(id) {
            if(this.users[id].showEditForm === false) {
                this.users[id].showEditForm = true
            } else {
                this.users[id].showEditForm = false
            }
            this.rerender = !this.rerender
        },
        updateUser(submitEvent, id) {
            if (submitEvent.target.elements.name.value === '' || submitEvent.target.elements.last_name.value === '' || submitEvent.target.elements.main_goal.value === '' || submitEvent.target.elements.phone_number.value === '' || submitEvent.target.elements.email.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                name: submitEvent.target.elements.name.value,
                last_name: submitEvent.target.elements.last_name.value,
                main_goal: submitEvent.target.elements.main_goal.value,
                phone_number: submitEvent.target.elements.phone_number.value,
                email : submitEvent.target.elements.email.value,
            }

            axios.put('/api/user/update/' + id, data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getUserData()
        },
        addTrainer (submitEvent) {
            if (submitEvent.target.elements.vardas.value === '' || submitEvent.target.elements.pavarde.value === '' || submitEvent.target.elements.specializacija.value === '' || submitEvent.target.elements.issilavinimas.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                vardas: submitEvent.target.elements.vardas.value,
                pavarde: submitEvent.target.elements.pavarde.value,
                specializacija: submitEvent.target.elements.specializacija.value,
                issilavinimas: submitEvent.target.elements.issilavinimas.value,
            }

            axios.post('/api/treneris/store', data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getTrainerData()
        },
        deleteTrainer(id) {
            axios.delete('/api/treneris/delete/' + id)
                .then(response => {
                    if (response.status === 200) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getTrainerData();
        },
        openTrainerEditForm(id) {
            if(this.trainers[id].showEditForm === false) {
                this.trainers[id].showEditForm = true
            } else {
                this.trainers[id].showEditForm = false
            }
            this.rerender = !this.rerender
        },
        updateTrainer(submitEvent, id) {
            if (submitEvent.target.elements.vardas.value === '' || submitEvent.target.elements.pavarde.value === '' || submitEvent.target.elements.specializacija.value === '' || submitEvent.target.elements.issilavinimas.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                vardas: submitEvent.target.elements.vardas.value,
                pavarde: submitEvent.target.elements.pavarde.value,
                specializacija: submitEvent.target.elements.specializacija.value,
                issilavinimas: submitEvent.target.elements.issilavinimas.value,
            }

            axios.put('/api/treneris/update/' + id, data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getTrainerData()
        },

        addGoal (submitEvent) {
            if (submitEvent.target.elements.tikslas.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                tikslas: submitEvent.target.elements.tikslas.value,
            }

            axios.post('/api/pagrindinis_tikslas/store', data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getGoalData()
        },
        deleteGoal(id) {
            axios.delete('/api/pagrindinis_tikslas/delete/' + id)
                .then(response => {
                    if (response.status === 200) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getGoalData();
        },
        openGoalEditForm(id) {
            if(this.goals[id].showEditForm === false) {
                this.goals[id].showEditForm = true
            } else {
                this.goals[id].showEditForm = false
            }
            this.rerender = !this.rerender
        },
        updateGoal(submitEvent, id) {
            if (submitEvent.target.elements.tikslas.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                tikslas: submitEvent.target.elements.tikslas.value,
            }

            axios.put('/api/pagrindinis_tikslas/update/' + id, data)
                .then(response => {
                    if (response.status === 201) {
                        //
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getGoalData()
        },
    },
    mounted() {
        this.getUserData()
        this.getTrainerData()
        this.getGoalData()
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
