<template>
    <div class="row">
        <div class="col-md-8">
            <hr />
            <div><h2><span v-html="user_info.name"></span></h2></div>
            <hr />
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
            let currentObj = this;
            currentObj.$root.loading = true;

            this.$http.get(currentObj.$baseUrl + 'user/' + localStorage.getItem('user_id'))
                .then(response => {
                    this.user = response.data.resource;
                    currentObj.$root.loading = false;
                    return this.$http.get(currentObj.$baseUrl + 'user-info/' + this.user.user_info_id)
                })
                .then(response => (this.user_info = response.data.resource))
                .catch((err) => {});
        }
    }
</script>
<style scoped>
</style>