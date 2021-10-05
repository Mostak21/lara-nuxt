<template lang="">
<div>
   <v-navigation-drawer temporary  v-model="sidebar" app>
    <!-- -->
  </v-navigation-drawer>

  <v-app-bar  class="mx-auto" color="#03A9F4" app>
    <span class="hidden-sm-and-up">
        <v-app-bar-nav-icon  @click.stop="sidebar = !sidebar"></v-app-bar-nav-icon> 
      </span>
      <v-toolbar-title class="mr-5">Newspaper</v-toolbar-title>
      
      <v-btn class="pa-4" text v-for="item in items" :key="item.id" :to="'/category/'+item.id">
        {{item.name}}
      </v-btn>
      
  </v-app-bar>
      </div>
</template>
<script>
export default {
    data(){
        return{
            category: [
      {
        icon: "mdi-ticket",
        title: "Login",
        to:"/login"
         
      },
      {
        icon: "mdi-ticket",
        title: "Sign In",
        to:"/login"
         
      },

      ],

      items:[],

      sidebar: false,
        }
    }

    ,

    mounted() {
      this.item();
    },

    methods: {
      item(){
        this.$axios.$get("/api/category")
        .then(res => {
          this.items=res;
          console.log(this.items);
        })
        .catch(err => {
          console.error(err); 
        })
      }
    },
}
</script>
<style lang="">
    
</style>