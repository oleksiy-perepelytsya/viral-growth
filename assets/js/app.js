import Vue from "vue";
import router from "./router";
import UserInfo from "./components/user-info";
import Registration from "./components/registration";
import Invites from "./components/invites";
import Login from "./components/login"

/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: {Login, UserInfo, Registration, Invites},
    router,
    data: {
        user_id: '',
        isAuthenticated: false,
        loading: false
    },
    created: function () {
        if (this.isAuthenticated) {
            this.$router.push('/user')
        }
    },
});