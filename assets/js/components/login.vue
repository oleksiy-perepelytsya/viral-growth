<template>
    <div>
        <div class="col col-lg-4"></div>
        <div class="col-lg-4 ml-auto">
            <form class="row" @submit.prevent="login">
                <div v-if="this.output" class="alert alert-danger" role="alert">
                    {{output}}
                </div>
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
                <router-link to="/registration" class="btn btn-default">
                    Registration
                </router-link>
            </form>
        </div>
        <div class="col col-lg-4"></div>
    </div>
</template>

<script>
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

                currentObj.output = '';
                currentObj.$root.loading = true;

                this.$http.post('http://viral-growth2.com/auth', currentObj.form)
                    .then(function (response) {
                        if(!response.data.id){
                            localStorage.setItem('isAuthenticated', false);
                            currentObj.output = response.data.message;
                        }else{
                            localStorage.setItem('user_id', response.data.id);
                            localStorage.setItem('isAuthenticated', true);
                            router.push('/user');
                        }
                        currentObj.$root.loading = false;
                    })
                    .catch(function (error) {
                        localStorage.setItem('isAuthenticated', false);
                        currentObj.$root.loading = false;
                    });

            }
        }
    }
</script>

<style lang="css">
</style>