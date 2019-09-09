import Vue from "vue";
import VueRouter from "vue-router";
import UserInfo from "../components/user-info";
import Registration from "../components/registration";
import Invites from "../components/invites";
import Login from "../components/login"

Vue.use(VueRouter);

const ifNotAuthenticated = (to, from, next) => {
    if (!Vue.isAuthenticated) {
        next()
        return
    }
    next('/')
}

const ifAuthenticated = (to, from, next) => {
    if (Vue.isAuthenticated) {
        next()
        return
    }
    next('/user')
}

export default new VueRouter({
    mode: "history",
    routes: [
        { name: 'login', path: "/", component: Login, beforeEnter: ifNotAuthenticated },
        { name: 'registration', path: "/registration", component: Registration, beforeEnter: ifNotAuthenticated },
        { name: 'user-info', path: "/user", component: UserInfo, beforeEnter: ifAuthenticated },
        { name: 'generate-invite-code', path: "/generate-invite-code", component: Invites, beforeEnter: ifAuthenticated },
        { path: '*', redirect: { path: "/" }}
    ]
});