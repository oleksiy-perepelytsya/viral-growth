import Vue from "vue";
import VueRouter from "vue-router";
import UserInfo from "../components/user-info";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { name: 'home', path: "/" },
        { name: 'user-info', path: "/user", component: UserInfo }
    ]
});