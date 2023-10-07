import createPersistedState from 'vuex-persistedstate'
import auth from './auth'
import { createStore } from 'vuex'

const store = createStore({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth
    }
});
export default store;