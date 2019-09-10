import Vue from "vue";
import VueRouter from "vue-router";
import UserInfo from "../components/user-info";
import Registration from "../components/registration";
import Invites from "../components/invites";
import Login from "../components/login"

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { name: 'login', path: "/", component: Login, beforeEnter: Vue.$ifNotAuthenticated },
        { name: 'registration', path: "/registration", component: Registration, beforeEnter: Vue.$ifNotAuthenticated },
        { name: 'user', path: "/user", component: UserInfo, beforeEnter: Vue.$ifAuthenticated },
        { name: 'generate-invite-code', path: "/generate-invite-code", component: Invites, beforeEnter: Vue.$ifAuthenticated },
        { path: '*', redirect: { path: "/" }}
    ]
});