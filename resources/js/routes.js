import { createRouter, createWebHistory} from 'vue-router'
import store from './store';

import NotFound from './components/404.vue';

import Login from './components/Login.vue';
import Venue from './components/Venue.vue';
import VenueCreate from './components/VenueCreate.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/:patchMatch(.*)*',
            component: NotFound
        },
        { 
            path: '/',
            component: Login,
            name: "Login",
            meta: {
                middleware: "guest",
                title: "Login"
            }
        },
        { 
            path: '/venue',
            component: Venue, 
            name: "Venue",
            meta: {
                middleware: "auth",
                title: "Venue"
            }
        },
        { 
            path: '/venue/create',
            component: VenueCreate,
            name: "VenueCreate",
            meta: {
                middleware: "auth",
                title: "VenueCreate"
            }
        }
    ]});

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - Venue Booking System`
    if(to.meta.middleware=="guest"){
        if(store.state.auth.authenticated){
            next({name:"Venue"})
        }
        next()
    }else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"Login"})
        }
    }
})

export default router;