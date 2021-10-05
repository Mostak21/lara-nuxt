<template lang="">
  <div>
    <v-snackbar v-model="snackbar">
      {{ msg }}

      <template v-slot:action="{ attrs }">
        <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <v-card>
      <v-card-title color="#B3E5FC" class="#B3E5FC pa-2"
        >Comments:</v-card-title
      >

<v-list two-line  > 
      <v-list-item-group
        active-class="pink--text"
        multiple
     
      >


      <template v-for="item in comment">
          <v-list-item :key="item.id">
            <template v-slot:default="{ active }">
              <v-list-item-content style="border-bottom: solid 1px #EEEEEE;" class="pa-3">
                <v-list-item-title > <v-icon color="#03A9F4"> mdi-account-arrow-right-outline </v-icon> {{item.user_id}}</v-list-item-title>

               <!-- <v-list-item-subtitle
                  class="text--primary"
                  v-text="item.headline"
                ></v-list-item-subtitle> -->

                <v-list-item-subtitle class="pl-5" v-text="item.content"></v-list-item-subtitle>
              </v-list-item-content>

              
<v-list-item-action v-if="loggedin">

                <v-icon 
                 
                  color="red darken-3" @click="delet_comment"
                >
                  mdi-delete-circle
                </v-icon>
              </v-list-item-action>
            </template>
          </v-list-item>

        
        </template>
      </v-list-item-group>
    </v-list>




    </v-card>
    <br>
    <v-card class="pa-6">
      <v-form v-model="issubform" ref="comment" @submit.prevent>
        <v-text-field v-if="loggedin"
          label="Name"
          v-model="comments.name"
          :rules="[rules.required]"
          filled
        ></v-text-field>
        <v-text-field v-if="!loggedin"
          label="Name"
          v-model="comments.name"
          :rules="[rules.required]"
          filled
        ></v-text-field>
        <v-text-field
          label="Comments"
          height="150px"
          v-model="comments.content"
          :rules="[rules.required]"
          filled
        ></v-text-field>
        

        <v-btn color="secondary" :disabled="!issubform" @click="add_comments">Add Comment</v-btn>
      </v-form>
     
    </v-card>
  </div>
</template>
<script>
export default {
  props: ["id","comment"],

  data() {
    return {
      isFormValid: false,
      issubform: false,

      msg: "",
      snackbar: false,

      loggedin: this.$store.state.auth.loggedIn,

      comments: {
         
        name: '',
        post_id: this.id,
        content: ''
      },

      
      rules: {
        required: value => !!value || "Please fill up the box",
        name: value => !!value || "Required.",
        content: value => !!value || "Required."
      }
    };
  },

  methods: {
    add_comments() {
      let data = new FormData();
      for (var key in this.comments) {
        data.append(key, this.comments[key]);
      }

      this.$axios
        .$post("/api/comment", data) 
        .then(res => {
          this.msg = res;
          this.snackbar = true;
          this.$refs.comment.reset();
          this.$nuxt.refresh()
          
        })
        .catch(err => {
          console.error(err);
        });

        
    },


    delet_comment(){
          console.log("hi baby");
    }
  }
};
</script>
<style lang=""></style>
