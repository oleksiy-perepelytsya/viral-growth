<template>
    <div>
        <div class="col col-lg-4"></div>
        <div class="col-lg-4 ml-auto">
            <div v-if="this.output" class="alert alert-danger" role="alert">
                {{output}}
            </div>
            <form class="row" @submit.prevent="login">
                <div class="form-group">
                    <label for="email" class="sr-only">Email address</label>
                    <input v-model="form.email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input v-model="form.password" type="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-md btn-primary" type="submit">Log in</button>
                <hr />
                <router-link to="/registration">
                    Registration
                </router-link>
            </form>
        </div>
        <div class="col col-lg-4"></div>
    </div>
</template>

<script>
    import Vue from "vue";
    import axios from 'axios';
    import router from "../router";

    export default {
        name: 'Login',
        data () {
            return {
                form: {
                    email: '',
                    password: ''
                },
                output : ''
            }
        },
        methods: {
            login (e) {
                e.preventDefault();
                let currentObj = this;

                axios.post('http://viral-growth.com/auth', currentObj.form)
                    .then(function (response) {
                        if(!response.data.id){
                            Vue.isAuthenticated = false;
                            currentObj.output = response.data.message;
                        }else{
                            Vue.user_id = response.data.id;
                            Vue.isAuthenticated = true;
                            router.push('/user');
                        }
                    })
                    .catch(function (error) {
                        Vue.isAuthenticated = false;
                        currentObj.output = error;
                    });
            }
        }
    }
</script>

<style lang="css">
</style>