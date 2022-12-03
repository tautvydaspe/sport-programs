<template>
    <div>
        <Navbar></Navbar>
        <div v-if="program" class="container">
            <div class="jumbotron text-white">
                <h1 class="display-4">{{program.pavadinimas}}</h1>
                <p class="lead">{{program.programos_pagrindine_dirbama_raumenu_grupe}}</p>
                <hr class="my-4">
                <p>Kaina: {{program.pavadinimas}}</p>
                <p class="mb-4">Trukme (savaitemis): {{program.trukme_sav}}</p>
                <hr />
                <h3>Treneris</h3>
                <div v-for="trainer in trainerData" :key="trainer.id">
                    <p>{{trainer.vardas}} {{trainer.pavarde}}</p>
                    <p>Specializacija: {{trainer.specializacija}}</p>
                    <p>Issilavinimas: {{trainer.issilavinimas}}</p>
                    <hr />
                </div>
            </div>
            <div v-if="reviewData.length>0">
                <h3 class="text-white">Komentarai</h3>
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <div class="w-75 p-3" style="background-color: #575757; color: white;" :key="rerender">
                        <div v-for="(review, index) in reviewData" :key="review.id">
                            <p><span style="font-size: 1.5rem; font-weight: 700; color: #548699">{{index+1}}</span> Programos tikslas: {{review.programos_tikslas}}; Pradinis kuno svoris: {{review.pradinis_kuno_svoris_kg}}kg; Dabartinis kuno svoris: {{review.dabartinis_kuno_svoris_kg}}kg</p>
                            <p>Atsiliepimas: {{review.atsiliepimas}}</p>
                            <button class="py-2 px-3" style="background-color: red;" @click="deleteReview(review.id)">TRINTI</button>
                            <button class="py-2 px-3" style="background-color: #548699;" @click="openEditForm(index)">REDAGUOTI</button>
                            <form v-if="review.showEditForm" class="mb-5 mt-1" style="color: white;" @submit.prevent="updateProgramReview($event,review.id)">
                                <input class="mb-1" style="width: 97%" type="text" name="atsiliepimas" :value=review.atsiliepimas />
                                <input style="width: 32%" type="text" name="pradinis_kuno_svoris_kg" :value=review.pradinis_kuno_svoris_kg />
                                <input style="width: 33%" type="text" name="dabartinis_kuno_svoris_kg" :value=review.dabartinis_kuno_svoris_kg />
                                <input style="width: 31.3%" type="text" name="programos_tikslas" :value=review.programos_tikslas />
                                <button style="width: 97%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Redaguoti</button>
                            </form>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="text-white mt-5 mb-0">Pridekite komentara apie programa</h3>
            <p class="text-white mb-3">Ir padekite del pirkimo apsispresti kitiems</p>
            <form class="mb-5" style="color: white;" @submit.prevent="addProgramReview">
                <input class="mb-1" style="width: 97%" type="text" name="atsiliepimas" placeholder="Atsiliepimas" />
                <input style="width: 32%" type="text" name="pradinis_kuno_svoris_kg" placeholder="Pradinis kuno svoris kg" />
                <input style="width: 33%" type="text" name="dabartinis_kuno_svoris_kg" placeholder="Dabartinis kuno svoris kg" />
                <input style="width: 31.3%" type="text" name="programos_tikslas" placeholder="Programos tikslas" />
                <button style="width: 97%; background-color: #4a8699" type="submit" class="px-4 py-2 mt-2">Įterpti</button>
            </form>
        </div>
        <div v-else class="text-center mt-4" style="color: white;">
            404 ERROR THIS PAGE WAS NOT FOUND
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
            program: [],
            rerender: false,
            trainerData: [],
            reviewData: [],
            atsiliepimas: {
                atsiliepimas: "",
                pradinis_kuno_svoris_kg: 0,
                dabartinis_kuno_svoris_kg: 0,
                programos_tikslas: "",
                programa_id : 1,
            },
        }
    },
    methods: {
        getProgramData (id) {
            axios.get('/api/programa/' + id)
                .then( response => {
                    this.program = response.data
                })
                .catch( error => {
                    console.log( error );
                })
        },
        getProgramTrainers (id) {
            axios.get('/api/programa/' + id + '/treneriai')
                .then( response => {
                    this.trainerData = response.data
                })
                .catch( error => {
                    console.log( error );
                })
        },
        getProgramReviews (id) {
            axios.get('/api/programa/' + id + '/reviews')
                .then( response => {
                    this.reviewData = response.data
                    this.reviewData.forEach(review => {
                        review.showEditForm = false
                    })
                    console.log(this.reviewData)
                })
                .catch( error => {
                    console.log( error );
                })
        },
        addProgramReview (submitEvent) {
            if (submitEvent.target.elements.atsiliepimas.value === '' || submitEvent.target.elements.pradinis_kuno_svoris_kg.value === '' || submitEvent.target.elements.dabartinis_kuno_svoris_kg.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                    atsiliepimas: submitEvent.target.elements.atsiliepimas.value,
                    pradinis_kuno_svoris_kg: parseFloat(submitEvent.target.elements.pradinis_kuno_svoris_kg.value),
                    dabartinis_kuno_svoris_kg: parseFloat(submitEvent.target.elements.dabartinis_kuno_svoris_kg.value),
                    programos_tikslas: submitEvent.target.elements.programos_tikslas.value,
                    programa_id : this.id,
                }

            axios.post('/api/programa/review/store', data)
                .then(response => {
                    if (response.status === 201) {
                            this.atsiliepimas.atsiliepimas = ""
                            this.atsiliepimas.pradinis_kuno_svoris_kg = 0
                            this.atsiliepimas.dabartinis_kuno_svoris_kg = 0
                            this.atsiliepimas.programos_tikslas = ""
                            this.atsiliepimas.programa_id = 1
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramReviews(this.id)
        },

        deleteReview(id) {
            axios.delete('/api/programa/review/delete/' + id)
                .then(response => {
                    if (response.status === 200) {
                        //Sitoje vietoje reiketu daryt emita
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramReviews(this.id);
        },
        openEditForm(id) {
            if(this.reviewData[id].showEditForm === false) {
                this.reviewData[id].showEditForm = true
            } else {
                this.reviewData[id].showEditForm = false
            }
            this.rerender = !this.rerender
        },
        updateProgramReview(submitEvent, id) {
            if (submitEvent.target.elements.atsiliepimas.value === '' || submitEvent.target.elements.pradinis_kuno_svoris_kg.value === '' || submitEvent.target.elements.dabartinis_kuno_svoris_kg.value === '') {
                alert("Ne visi duomenys ivesti");
            }

            let data = {
                atsiliepimas: submitEvent.target.elements.atsiliepimas.value,
                pradinis_kuno_svoris_kg: parseFloat(submitEvent.target.elements.pradinis_kuno_svoris_kg.value),
                dabartinis_kuno_svoris_kg: parseFloat(submitEvent.target.elements.dabartinis_kuno_svoris_kg.value),
                programos_tikslas: submitEvent.target.elements.programos_tikslas.value,
                programa_id : this.id,
            }

            axios.put('/api/programa/review/update/' + id, data)
                .then(response => {
                    if (response.status === 201) {
                        this.atsiliepimas.atsiliepimas = ""
                        this.atsiliepimas.pradinis_kuno_svoris_kg = 0
                        this.atsiliepimas.dabartinis_kuno_svoris_kg = 0
                        this.atsiliepimas.programos_tikslas = ""
                        this.atsiliepimas.programa_id = 1
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            this.getProgramReviews(this.id)
        },
    },
    created() {
        this.id = this.$route.params.id;
        this.getProgramData(this.id)
        this.getProgramTrainers(this.id);
        this.getProgramReviews(this.id);
    }
}
</script>
