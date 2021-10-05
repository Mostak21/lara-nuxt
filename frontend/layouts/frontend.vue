<template lang="">
   <v-app >
  
   <navbar>
     
   </navbar>
  <!-- Sizes your content based upon application components -->
  <v-main>

    <!-- Provides the application the proper gutter -->
    <v-container fluid >
<Nuxt/>

      <!-- If using vue-router -->
     
    </v-container>
  </v-main>

  <v-footer app>
    <!-- -->
  </v-footer>
</v-app>
</template>
<script>
import navbar from '../components/frontend/navbar'
export default {
    components:{
        navbar
    },
    data(){
        return{
            
        }
    }
}
</script>
<style lang="">
    
</style>