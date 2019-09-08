<template>
    <div>
        <p>This is an user info</p>
        <span v-html="user.email"></span>
        <span v-html="user_info.name"></span>
        <span v-html="user_info.description"></span>

        <Invites />
    </div>
</template>
<script>
    import axios from 'axios';
    import Invites from "./invites";

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
            axios.get('http://viral-growth.com/user/2')
                .then(response => {
                    this.user = response.data.resource;
                    return axios.get('http://viral-growth.com/user-info/' + this.user.user_info_id)
                })
                .then(response => (this.user_info = response.data.resource))
                .catch((err) => {});
        }
    }
</script>
<style scoped>
</style>