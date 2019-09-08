import Vue from "vue";
import router from "./router";
import UserInfo from "./components/user-info";
import Registration from "./components/registration";
import Invites from "./components/invites";
/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: {UserInfo, Registration, Invites},
    router
});