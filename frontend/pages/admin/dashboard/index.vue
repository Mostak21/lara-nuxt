<template lang="">
    <div>
        <h4>{{ user.name }} ->{{user.id}}</h4>
    </div>
</template>
<script>
export default {
    middleware: 'auth',
    computed: {
        user(){
            
            return this.$store.state.auth.user;
        }
    }
}
</script>
<style lang="">
    
</style>