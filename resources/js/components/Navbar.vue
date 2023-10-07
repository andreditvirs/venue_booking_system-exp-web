<template>
<nav class="navbar navbar-expand-lg navbar-light bg-dark px-5 mb-5">
    <a class="navbar-brand text-warning" href="#"><b>Venue Booking System</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <router-link class="nav-link text-light" to="/booking">Booking Venue <span class="sr-only">(current)</span></router-link>
        </li>
        <li class="nav-item">
            <router-link class="nav-link text-light" to="/venue">Venue</router-link>
        </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <h6 class="text-light my-2">Hai, {{ user.username }}</h6>  
        <button class="btn btn-outline-danger mx-2 my-2 my-sm-0" @click.prevent="logout">Logout</button>
        </form>
    </div>
</nav> 
</template>
<script>
import {mapActions} from 'vuex'
export default {
    data(){
        return {
            user: this.$store.state.auth.user
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await axios.post('/api/logout').then(({data})=>{
                this.signOut()
                this.$router.push({name:"Login"})
            })
        }
    }   
}
</script>