<template lang="">
  <div>
    <v-container>
      <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
     
      <v-card>
        <v-card-title>
          <span class="text-h5">User Profile</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Name"
                  v-model="eidted_cat.name"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Legal middle name"
                  hint="example of helper text only on focus"
                ></v-text-field>
              </v-col>

              
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="save_items(eidted_cat.id)"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
      <v-row>
        <div class=" text-right"> 
          <v-snackbar v-model="snackbar">
            {{ msg }}

            <template v-slot:action="{ attrs }">
              <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
                Close
              </v-btn>
            </template>
          </v-snackbar>
        </div>
        <v-col md="6">
          <v-card rounded-md>
            <div class="pa-2  text-left  primary">
              <h4>Category</h4>
            </div>
            <div class="pa-4">
              <v-form v-model="isFormValid" @submit.prevent>
                <v-text-field
                  label="Caregory"
                  :rules="[rules.required]"
                  v-model="category.name"
                  filled
                ></v-text-field>

                <v-file-input
                  v-model="category.image"
                  placeholder="Upload your Category Header pic"
                  label="File input"
                  :rules="[rules.image]"
                  accept="image/png, image/jpeg, image/bmp"
                  @change="Preview_image"
                  prepend-icon="mdi-paperclip"
                >
                  <template v-slot:selection="{ text }">
                    <v-chip small label color="secondary">
                      {{ text }}
                    </v-chip>
                  </template>
                </v-file-input>

                <v-img
                  v-if="url"
                  :src="url"
                  height="150px"
                  width="400px"
                ></v-img>

                <v-btn color="secondary" :disabled="!isFormValid" @click="add_category"
                  >Add Category</v-btn
                >
              </v-form>
            </div>
          </v-card>
        </v-col>

        <v-col md="6">
          <div class="pa-2  text-left primary">Category List:</div>
          <v-list-item v-for="item in catitems" :key="item.id" class="pl-3 mb-1">
            
            <v-list-item-content>
              <v-list-item-title>{{ item.name }}</v-list-item-title>
            </v-list-item-content>
            <v-icon @click="edit_items(item.id)">mdi-circle-edit-outline</v-icon
            ><v-icon @click="delete_items(item.id)"
              >mdi-delete-circle-outline</v-icon
            >
            
          </v-list-item>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {
  data: () => ({
    category: {
      name: "",
      image: [],
      slag: "",
      state: ""
    },

    eidted_cat: [],

    dialog: false,
    isFormValid: false,
    
    url: null,
    catitems: [],
    msg: "",
    snackbar: false,

    rules: {
      required: value => !!value || "Please fill up the box",
      image: value =>
        !!value || "Please select a image",
      content: value => !!value || "Required."
    }
  }),

mounted() {
   this.fetch()
  },

  

  methods: {

    fetch(){
        this.$axios
          .$get("http://127.0.0.1:8000/api/category")
          .then(res => {
            this.catitems = res;
          })
          .catch(err => {
            console.error(err);
          });
    },

    add_category() {
      
      
      let Data = new FormData();
      for (var key in this.category) {
        Data.append(key, this.category[key]);
      }
      
      this.$axios
        .$post("http://127.0.0.1:8000/api/category", Data)
        .then(res => {
          this.msg = res;
          this.snackbar = true;
          this.fetch();
          this.category.name = "";
          this.category.image = [];
          this.category.slag = "";
          this.category.state = "";
          this.url = null;

        
        })
        .catch(err => {
          console.error(err);
        })

      
    },

    Preview_image() {
      if (!this.category.image) this.url = null;
      if (this.category.image)
        this.url = URL.createObjectURL(this.category.image);
    },

    edit_items(e) {

      this.$axios.$get('http://127.0.0.1:8000/api/category/'+e+'/edit')
      .then(res => {
        this.eidted_cat=res;
      })
      .catch(err => {
        console.error(err); 
      })

      this.dialog=true;



    },

    save_items(e){

      this.$axios.$put('http://127.0.0.1:8000/api/category/'+e,this.eidted_cat)
      .then(res => {
        this.fetch();
        this.dialog=false;
      })
      .catch(err => {
        console.error(err); 
      })

    },
    delete_items(e) {
      this.$axios.$delete('http://127.0.0.1:8000/api/category/'+e)
      .then(res => {
        
         this.fetch();
         this.msg=res;
         this.snackbar = true;
       
      })
      .catch(err => {
        console.error(err); 
      })
    }
  }
};
</script>
<style lang="">



</style>
