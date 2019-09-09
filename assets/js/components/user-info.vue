<template>
    <div class="row">
        <div class="col-md-8">
            <h2><span v-html="user_info.name"></span></h2>
            <div><img src="https://picsum.photos/600/400"/></div>
            <hr />
            <ul class="list-group">
                <li class="list-group-item flex-column"><span v-html="user_info.description"></span></li>
            </ul>
        </div>
        <div class="col-md-4">
            <Invites />
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import Invites from "./invites";
    import Vue from "vue";

    export default {
        name: "user-info",
        components: {
            Invites
        },
        data () {
            return {
                user: {
                    email : '',
                    user_info_id : ''
                },
                user_info: {
                    name: '',
                    description: ''
                }
            }
        },
        created () {
            Vue.loading = true;

            axios.get('http://viral-growth.com/user/' + Vue.user_id)
                .then(response => {
                    this.user = response.data.resource;
                    return axios.get('http://viral-growth.com/user-info/' + this.user.user_info_id)
                })
                .then(response => (this.user_info = response.data.resource))
                .catch((err) => {});

            Vue.loading = false;
        }
    }
</script>
<style scoped>
</style>