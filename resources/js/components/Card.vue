<template>
    <div class="card h-100">
        <img class="card-img-top" :src="file_image" :alt="nama" style="height: 140px; object-fit: none; object-position: center;">
        <div class="card-body">
            <h5 class="card-title">{{ nama }}</h5>
            <p class="card-text" style="font-size: 10px">{{ alamat }}</p>
        </div>
        <div class="card-footer">
            <button class="btn btn-danger w-100" @click="deleteVenue(id)">Delete Venue</button>
        </div>
    </div>        
</template>
<script>
export default {
    props: ['file_image', 'nama', 'kategori', 'alamat', 'id', 'deleteVenue'],
    data(){
        return {
            
        }
    },
    methods: {
    }
}
</script>