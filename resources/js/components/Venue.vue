<template>
    <Navbar />
    <div class="container">
        <div class="row my-3">
            <div class="col-10"><h2>Venue</h2></div>
            <router-link class="col-2 ml-auto btn btn-success" to="/venue/create">Create</router-link>
        </div>
        <div class="row my-3">
            <div class="col-lg-3 col-md-3 col-sm-12 my-2" v-for="v in venue" :key="v.id">
                <Card 
                    :id="v.id"
                    :file_image="`/image/`+v.file_image"
                    :nama="v.nama" 
                    :kategori="v.kategori"
                    :alamat="v.alamat"
                    :deleteVenue="deleteVenue"
                />
            </div>
        </div>
    </div>
</template>
<script>
    import Navbar from './Navbar.vue';
    import Card from './Card.vue';
    export default {
        components: {
            Navbar, Card
        },
        data(){
            return {
                venue: []
            }
        },
        mounted(){
            this.getVenue();
        },
        methods: {
            getVenue(){
                axios.get('/api/venue').then(({ data }) => {this.venue = data;} );
            },
            async deleteVenue(id){
                const data = new FormData;
                data.append('id', id);
                await axios.get('/sanctum/csrf-cookie');
                await axios.delete(`/api/venue/${id}`);

                this.getVenue();
            }
        }
    }
</script>