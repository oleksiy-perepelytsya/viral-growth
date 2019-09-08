import Vue from "vue";
import VueRouter from "vue-router";
import UserInfo from "../components/user-info";
import Registration from "../components/registration";
import Invites from "../components/invites";
// import NotFound from '../components/not-found'

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { name: 'home', path: "/" },
        { name: 'registration', path: "/registration", component: Registration },
        { name: 'user-info', path: "/user", component: UserInfo },
        { name: 'generate-invite-code', path: "/generate-invite-code", component: Invites },
        // { path :'*', component: NotFound }
    ]
});