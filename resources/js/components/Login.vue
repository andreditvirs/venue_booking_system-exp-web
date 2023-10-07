<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="text-center my-3">
                    <h4>Login Page</h4>
                    <i>Venue Booking System</i>
                </div>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username" v-model="form.username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" v-model="form.password">
                    </div>
                    <button @click.prevent="loginUser" type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data(){
        return {
            form: {
                username: '',
                password: ''
            },
            errors: []
        }
    },
    methods: {
        ...mapActions({
            signIn:'auth/login'
        }),
        async loginUser(){
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/login',this.form).then(()=>{
                this.signIn()
            })
        },
    }
}
</script>