<template>
    <div>
        <div>
            <button v-on:click="createNewInvite" class="btn btn btn-success">Get new Viral Code!</button>
            <a href="http://viral-growth.com" class="btn btn-default">Logout</a>
        </div>
        <hr/>
        <h3>Viral Codes</h3>
        <span><b>Total:</b>{{ invites.length }}</span>
        <span><b>Used:</b>{{ counterUsed }}</span>

        <ol id="viral-codes" class="list-group">
            <li v-for="invite in invites" class="list-group-item" :class="{ 'list-group-item-success' : invite.status == 'used'}">
                {{ invite.code }}
                <h5 v-if="invite.status == 'used'"><b>Infected!</b></h5>
            </li>
        </ol>
    </div>
</template>
<script>
    import axios from 'axios';
    import Vue from "vue";

    export default {
        name: "invites",
        data () {
            return {
                invites: [],
                counterUsed: 0
            }
        },
        created () {
            let currentObj = this;

            axios.get('http://viral-growth.com/invite/user/' + Vue.user_id)
             .then(function (response) {
                 currentObj.invites = response.data.resource;

                 currentObj.invites.filter(function(invite) {
                     if(invite.status == 'used'){++currentObj.counterUsed;}
                 });
             })
            .then(response => (this.invites = response.data.resource))
            .catch((err) => {});
        },
        methods: {
            createNewInvite: function() {
                let currentObj = this;

                axios.get('http://viral-growth.com/invite/create/user/' + Vue.user_id)
                    .then(function (response) {
                        currentObj.invites.unshift(response.data.resource)
                        alert('Share your new Viral Code: ' + response.data.resource.code);
                    })
                    .catch((err) => {});

            }
        },
        watch: {
            counterUsed: function(){

            }
        }
    }
</script>
<style scoped>
</style>