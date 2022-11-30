<template>
    <div>
        <Navbar></Navbar>
        <div v-if="program">
            <div class="jumbotron text-white">
                <h1 class="display-4">{{program.pavadinimas}}</h1>
                <p class="lead">{{program.programos_pagrindine_dirbama_raumenu_grupe}}</p>
                <hr class="my-4">
                <p>Price: {{program.pavadinimas}}</p>
                <p class="mb-4">Length (weeks): {{program.trukme_sav}}</p>
                <hr />
                <h3>Trainer</h3>
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
                    <div class="w-75 p-3" style="background-color: #575757; color: white;">
                        <div v-for="(review, index) in reviewData" :key="review.id">
                            <p><span style="font-size: 1.5rem; font-weight: 700; color: #548699">{{index+1}}</span> Programos tikslas: {{review.programos_tikslas}}; Pradinis kuno svoris: {{review.pradinis_kuno_svoris_kg}}kg; Dabartinis kuno svoris: {{review.dabartinis_kuno_svoris_kg}}kg</p>
                            <p>Atsiliepimas: {{review.atsiliepimas}}</p>
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
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
            trainerData: [],
            reviewData: [],
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
                })
                .catch( error => {
                    console.log( error );
                })
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
