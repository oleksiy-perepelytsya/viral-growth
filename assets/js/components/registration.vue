<template>
    <div class="row col-6">
        <p>Register and send invites!</p>
        <form class="login" @submit="formSubmit">

            <div class="form-group input-group-lg">
                <input required v-model="form.code" type="text" aria-label="Large" class="form-control" id="code" placeholder="Viral Code">
            </div>

            <div class="form-group">
                <input required v-model="form.email" type="email" class="form-control" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <input required v-model="form.password" type="password" class="form-control" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <input required v-model="form.password2" type="password" class="form-control" id="password2" placeholder="Repeat Password">
            </div>

            <div class="form-group">
                <input required v-model="form.name" type="text" class="form-control" id="name" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea required v-model="form.description" class="form-control" id="description" rows="3"></textarea>
            </div>

            <hr/>
            <button type="submit" class="btn btn-primary">Go! Go! Go!</button>
        </form>
        <div>
            {{output}}
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        name: "registration",
        data () {
            return {
                form: {
                    code : '',
                    email : '',
                    password : '',
                    password2 : '',
                    name : '',
                    description : ''
                },
                output : ''
            }
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;

                axios.post('http://viral-growth.com/user/create', currentObj.form)
                    .then(function (response) {
                        currentObj.output = response.data.message;
                    })
                    .catch(function (error) {
                        currentObj.output = error;
                    });
            }
        }
    }
</script>
<style scoped>
</style>