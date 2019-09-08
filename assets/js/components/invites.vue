<template>
    <div>
        <div id="">
            <button v-on:click="createNewInvite">Get new Viral Code!</button>
        </div>
        <ol>
            <li v-for="invite in invites">
                {{ invite.code }}
                {{ invite.status }}
            </li>
        </ol>
    </div>
</template>
<script>
    import axios from 'axios';
    import router from "../router";

    export default {
        name: "invites",
        data () {
            return {
                invites: [],
                new_invite: {}
            }
        },
        created () {
             axios.get('http://viral-growth.com/invite/user/2')
                .then(response => (this.invites = response.data.resource))
                .catch((err) => {});
        },
        methods: {
            createNewInvite: function() {
                axios.get('http://viral-growth.com/invite/create/user/2')
                    .then(response => (this.new_invite = response.data.resource))
                    .catch((err) => {});
                window.location.href = "http://viral-growth.com/user-info";
            }
        }
    }
</script>
<style scoped>
</style>