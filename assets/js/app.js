import Vue from "vue";
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';
import axios from 'axios';
import router from "./router";
import UserInfo from "./components/user-info";
import Registration from "./components/registration";
import Invites from "./components/invites";
import Login from "./components/login";
import PacmanLoader from 'vue-spinner/src/PacmanLoader.vue'

Vue.use(Vuex);

const store = new Vuex.Store({
    state:{
        user_id: '',
        isAuthenticated: false,
    },
    plugins: [createPersistedState()]
});


Vue.prototype.$ifNotAuthenticated = (to, from, next) => {
    if (localStorage.getItem('isAuthenticated')) {
        next();
        return;
    }
    if(to.path !== "/login"){
        next('/');
    }
}

Vue.prototype.$ifAuthenticated = (to, from, next) => {
    if (localStorage.getItem('isAuthenticated')) {
        next();
        return;
    }
    if(to.path !== "/login"){
        next('/');
    }
}

Vue.prototype.$http = axios;
Vue.prototype.$baseUrl = 'http://viral-growth2.com/';

new Vue({
    el: '#app',
    components: {Login, UserInfo, Registration, Invites, PacmanLoader},
    router,
    methods: {
        showSpinner() {
            this.loading = true;
        },
        hideSpinner() {
            this.loading = false;
        }
    },
    data: () => {
        return {
            color: '#5cb85c',
            size: '25px',
            loading: false
        }
    },
});