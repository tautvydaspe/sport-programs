<template>
    <div>
        <header>
            <Navbar></Navbar>
            <div class="hero-image">
                <div class="container">
                    <div class="hero-text pt-5">
                        <h6>YOU'RE MORE THAN JUST A MEMBER</h6>
                        <h1 class="pb-5">
                            Gym programs <br />
                            developed by <br />
                            best minds.
                        </h1>
                        <a class="py-3 px-4 mb-5" href="#programs">GET STARTED NOW</a>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div>
                <form class="mt-5" style="color: white;" enctype="multipart/form-data" @submit.prevent="addProgram">
                    <input type="text" name="pavadinimas" placeholder="pavadinimas" />
                    <input type="text" name="trukme_sav" placeholder="trukme_sav" />
                    <input type="text" name="kaina" placeholder="kaina" />
                    <select name="fk_tikslas_id">
                        <option v-for="(tikslas, index) in pagrindiniai_tikslai" :value="tikslas.id">{{tikslas.tikslas}}</option>
                    </select><br>
                    <input type="radio" name="programos_pagrindine_dirbama_raumenu_grupe" value="peciu_juosta">
                    <label for="html">peciu_juosta</label>
                    <input type="radio" name="programos_pagrindine_dirbama_raumenu_grupe" value="rankos">
                    <label for="css">rankos</label>
                    <input type="radio" name="programos_pagrindine_dirbama_raumenu_grupe" value="kojos">
                    <label for="javascript">kojos</label>
                    <input type="radio" name="programos_pagrindine_dirbama_raumenu_grupe" value="sedmenys">
                    <label for="javascript">sedmenys</label>
                    <input type="radio" name="programos_pagrindine_dirbama_raumenu_grupe" value="korpusas">
                    <label for="javascript">korpusas</label><br>
                    <input type="file" name="nuotrauka" placeholder="Nuotrauka" @change="onImageChange" /><br>
                    <button type="submit" class="px-4 py-2 mt-2 w-100">Įterpti</button>
                </form>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-between my-5" :key="rerender">
                    <div class="col-12 col-lg-6 mb-5" style="color: white;" v-for="(program, index) in programs" :key="index">
                        <div id="programs" class="image-container program-card w-100">
                            <img
                                v-if="index===0"
                                src="http://127.0.0.1:8000/storage/strength.jpg"
                                alt="Snow"
                                style="width: 100%; opacity: 0.5; border-radius: 10px;"
                            />
                            <img
                                v-if="index===1"
                                src="http://127.0.0.1:8000/storage/bodyweight.jpg"
                                alt="Snow"
                                style="width: 100%; opacity: 0.5; border-radius: 10px;"
                            />
                            <img
                                v-if="index===2"
                                src="http://127.0.0.1:8000/storage/bodybuilding_(2).jpg"
                                alt="Snow"
                                style="width: 100%; opacity: 0.5; border-radius: 10px;"
                            />
                            <img
                                v-if="index>2"
                                :src="`http://127.0.0.1:8000/images/${program.nuotrauka}`"
                                alt="Snow"
                                style="width: 100%; opacity: 0.5; border-radius: 10px;"
                            />
                            <div class="centered">
                                <h2>{{program.pavadinimas}}</h2>
                                <h4 class="my-3">${{program.kaina}} USD</h4>
                                <router-link :to="`programa/${program.id}`">GET IT NOW</router-link>
                                <button class="py-2 px-3" style="background-color: red;" @click="deleteItem(program.id)">DELETE</button>
                                <button class="py-2 px-3" style="background-color: #548699;" @click="openEditForm(index)">REDAGUOTI</button>
                                <form v-if="program.showEditForm" class="mb-5 mt-1" style="color: white;" @submit.prevent="updateProgram($event,program.id)">
                                    <input style="width: 100%;" type="text" name="pavadinimas" :value=program.pavadinimas />
                                    <input style="width: 100%;" type="text" name="trukme_sav" :value=program.trukme_sav />
                                    <input style="width: 100%;" type="text" name="kaina" :value=program.kaina />
                                    <button style="width: 100%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Redaguoti</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text mt-5">
                Pasirinkta sporto programų tema. Treneriai siunčia programas su sportu
                susijusiam tinklalapio administratoriui (projekto savininku), jis jas
                įvertina ir atrinktas skelbia savo tinklalapyje. Tokiu būdu treneriai
                gauna galimybę garsinti savo vardą profesinėje srityje, kas treneriams
                yra ypatingai svarbu. Vartotojai atėję į tinklalapį gali parsisiųsti
                programas ir sportuoti pagal jas.
            </div>
        </main>
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
            rerender: false,
            programs: [],
            programa: {
                pavadinimas: "",
                trukme_sav: 0,
                kaina: 0,
                programos_pagrindine_dirbama_raumenu_grupe: "",
                fk_tikslas_id: 1,
            },
            pagrindiniai_tikslai: {},
            showLogout: false,
            nuotrauka: "",
        }
    },
    methods: {
        getProgramsList() {
            axios.get('/api/programos')
                .then(response => {
                    this.programs = response.data
                    this.programs.forEach(program => {
                        program.showEditForm = false
                    })
                })
                .catch(error => {
                    alert(error);
                })
        },
        getAimsList() {
            axios.get('/api/pagrindiniai_tikslai')
                .then(response => {
                    this.pagrindiniai_tikslai = response.data
                    console.log(response)
                })
                .catch(error => {
                    alert(error);
                })
        },
        addProgram(submitEvent) {
            if (submitEvent.target.elements.pavadinimas.value === '' || submitEvent.target.elements.trukme_sav.value === '' || submitEvent.target.elements.kaina.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            const config = {
                headers:{'Content-Type' : 'multipart/form-data'}
            };

            const data = new FormData();

            data.append('pavadinimas', submitEvent.target.elements.pavadinimas.value);
            data.append('trukme_sav', parseInt(submitEvent.target.elements.trukme_sav.value));
            data.append('kaina', parseFloat(submitEvent.target.elements.kaina.value));
            data.append('programos_pagrindine_dirbama_raumenu_grupe', submitEvent.target.elements.programos_pagrindine_dirbama_raumenu_grupe.value);
            data.append('nuotrauka', this.nuotrauka);
            data.append('programos_pagrindine_dirbama_raumenu_grupe', this.categories_id);
            data.append('fk_tikslas_id', parseInt(submitEvent.target.elements.fk_tikslas_id.value));

            axios.post('api/programa/store', data, config)
                .then(response => {
                    if (response.status === 201) {
                        this.programa.pavadinimas = "";
                        this.programa.trukme_sav = "";
                        this.programa.kaina = "";
                        this.programa.fk_tikslas_id = "";
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramsList();
        },
        deleteItem(id) {
            axios.delete('api/programa/' + id)
                .then(response => {
                    if (response.status === 200) {
                        //Sitoje vietoje reiketu daryt emita
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramsList();
        },
        onImageChange(e) {
            console.log(e.target.files[0]);
            this.nuotrauka = e.target.files[0];
        },
        openEditForm(id) {
            if(this.programs[id].showEditForm === false) {
                this.programs[id].showEditForm = true
            } else {
                this.programs[id].showEditForm = false
            }
            this.rerender = !this.rerender
        },
        updateProgram(submitEvent, id) {
            if (submitEvent.target.elements.pavadinimas.value === '' || submitEvent.target.elements.trukme_sav.value === '' || submitEvent.target.elements.kaina.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                pavadinimas: submitEvent.target.elements.pavadinimas.value,
                trukme_sav: parseInt(submitEvent.target.elements.trukme_sav.value),
                kaina: parseFloat(submitEvent.target.elements.kaina.value),
            }

            axios.put('/api/programa/' + id, data)
                .then(response => {
                    if (response.status === 201) {
                        this.programa.pavadinimas = ""
                        this.programa.trukme_sav = 0
                        this.programa.kaina = 0
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramsList()
        },
    },
    created() {
        this.getProgramsList()
        this.getAimsList()
    },
}
</script>
