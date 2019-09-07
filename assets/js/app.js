import Vue from "vue";
import router from "./router";
import UserInfo from "./components/user-info";
/**
 * Create a fresh Vue Application instance
 */
new Vue({
    el: '#app',
    components: {UserInfo},
    router
});