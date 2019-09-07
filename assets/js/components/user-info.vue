<template>
    <div>
        <p>This is an user info</p>
    </div>
</template>
<script>
    export default {
        name: "user-info",
        mounted () {
            axios
                .get('http://viral-growth.com/user/1')
                .then(response => (this.info = response))
        }
    }
</script>
<style scoped>
</style>