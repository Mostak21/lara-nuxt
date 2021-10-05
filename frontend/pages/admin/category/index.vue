<template lang="">
  <div>
    <v-container>
      <!--Dialog box for updating data-->
      <v-row justify="center">
        <v-dialog v-model="dialog" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="text-h5">Edit Category</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="12">
                    <v-select
                      v-if="subcategory" 
                      label="Parent"
                      v-model="eidted_cat.cat_name"
                      :items="cat_list"
                      item-text="name"
                      item-value="name"
                      dense
                      solo
                    ></v-select>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      label="Name"
                      v-model="eidted_cat.name"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      label="Slag"
                      v-model="eidted_cat.slag"
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" sm="6" md="4">
                    <v-text-field
                      label="State"
                      v-model="eidted_cat.state"
                    ></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="dialog = false">
                Close
              </v-btn>
              <v-btn color="blue darken-1" text @click="save_items(eidted_cat)">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
      <!--Dialog box for updating data end-->
      <v-row>
        <!--snak baar start-->
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

        <!--snak baar End-->
        <!--Category Start-->
        <v-col cols="12" md="6" sm="12" xs="12">
          <v-card rounded-md>
            <div class="pa-2  text-left  primary">
              <h4>Category</h4>
            </div>
            <div class="pa-4">
              <v-form v-model="isFormValid" @submit.prevent>
                <v-row>
                   <v-col cols="12" md="6" sm="12" xs="12">
                     <v-text-field
                  label="Category"
                  :rules="[rules.required]"
                  v-model="category.name"
                  dense
                  solo
                ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" xs="12">
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
                    </v-col>

                </v-row>

                 <v-row>
                   <v-col cols="12" md="6" sm="12" xs="12">
                     <v-text-field
                  label="Slag"
                  
                  v-model="category.slag"
                  dense
                  solo
                ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6" sm="12" xs="12">
                      <v-text-field
                  label="Sate"
                  
                  v-model="category.state"
                  dense
                  solo
                ></v-text-field>
                    </v-col>

                </v-row>
                

                

                <v-img
                  v-if="url"
                  :src="url"
                  height="150px"
                  width="400px"
                ></v-img>

                <v-btn
                  color="secondary"
                  :disabled="!isFormValid"
                  @click="add_category"
                  >Add Category</v-btn
                >
              </v-form>
            </div>
          </v-card>
        </v-col>

        <v-col cols="12" md="6" sm="12" xs="12">
          <cat
            ref="data"
            @clicked="set_message"
            @subcat="subcategory = false"
            @dialoguechange="set_dialogue"
            @cat_edited="set_data"
          />
        </v-col>
      </v-row>
      <!--Category End-->
      <!--Sub Category Start-->

      <v-row>
        <v-col cols="12" md="6" sm="12" xs="12">
          <v-card rounded-md>
            <div class="pa-2  text-left  primary">
              <h4>Sub Category</h4>
            </div>

            <div class="pa-4">
              <v-form v-model="issubform" @submit.prevent>
                <v-row>
                  <v-col cols="12" md="6" sm="12" xs="12">
                    <v-select
                      label="Parent Category"
                      v-model="sub_category.cat_id"
                      :items="cat_list"
                      item-text="name"
                      item-value="id"
                      dense
                      solo
                    ></v-select> </v-col
                  ><v-col cols="12" md="6" sm="12" xs="12">
                    <v-text-field
                      label="Sub Category"
                      :rules="[rules.subcat]"
                      v-model="sub_category.name"
                      dense
                      solo
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" md="6" sm="12" xs="12">
                    <v-text-field
                      label="Slag"
                      v-model="sub_category.slag"
                      dense
                      solo
                    ></v-text-field>
                  </v-col>

                  <v-col cols="12" md="6" sm="12" xs="12">
                    <v-text-field
                      label="State"
                      v-model="sub_category.state"
                      dense
                      solo
                    ></v-text-field>
                  </v-col>
                </v-row>

                <v-btn
                  color="secondary"
                  :disabled="!issubform"
                  @click="add_subcategory"
                  >Add Sub category</v-btn
                >
              </v-form>
            </div>
          </v-card>
        </v-col>

        <v-col md="6">
          <subcat
            ref="subcat"
            @clicked="set_message"
            @subcat="subcategory = true"
            @dialoguechange="set_dialogue"
            @cat_edited="set_data"
          />
        </v-col>
      </v-row>
      <!--Sub Category END-->
    </v-container>
  </div>
</template>
<script>
import cat from "~/components/category";
import subcat from "~/components/subcategory";
export default {
  components: {
    cat,
    subcat
  },
  data: () => ({
    category: {
      name: "",
      image: [],
      slag: "",
      state: ""
    },
    sub_category: {
      cat_id: null,
      name: null,
      slag: "",
      state: ""
    },
    subcategory: "",

    cat_list: ["item1", "item2"],

    cat_url: "http://127.0.0.1:8000/api/category",
    subcat_url: "http://127.0.0.1:8000/api/subcategory",
    api_url: null,

    eidted_cat: [],
    dialog: false,
    isFormValid: false,
    issubform: false,

    url: null,

    msg: "",
    snackbar: false,

    rules: {
      subcat: value => !!value || "Please fill up the box",
      image: value => !!value || "Please select a image",
      required: value => !!value || "Required."
    }
  }),

  created() {
    this.cat_fetch();
  },

  methods: {
    add_category() {
      let Data = new FormData();
      for (var key in this.category) {
        Data.append(key, this.category[key]);
      }

      this.$axios
        .$post(this.cat_url, Data)
        .then(res => {
          this.msg = res;
          this.snackbar = true;
          this.$refs.data.fetch();
          this.category.name = "";
          this.category.image = [];
          this.category.slag = "";
          this.category.state = "";
          this.url = null;
        })
        .catch(err => {
          console.error(err);
        });
    },

    cat_fetch() {
      this.$axios
        .$get(this.cat_url)
        .then(res => {
          this.cat_list = res;
        })
        .catch(err => {
          console.error(err);
        });
    },

    add_subcategory() {
      let Data = new FormData();
      for (var key in this.sub_category) {
        Data.append(key, this.sub_category[key]);
      }

      this.$axios
        .$post(this.subcat_url, Data)
        .then(res => {
          this.msg = res;
          this.snackbar = true;
          this.$refs.subcat.fetch();
          (this.sub_category.cat_id = ""), 
          (this.sub_category.name = null);
         
          this.sub_category.slag = "";
          this.sub_category.state = "";
          this.url = null;
        })
        .catch(err => {
          console.error(err);
        });
    },

    set_message(value) {
      this.msg = value.msg;
      this.snackbar = value.snackbar;
    },

    set_dialogue(value) {
      this.dialog = value;
    },

    set_data(value) {
      console.log(value);
      this.eidted_cat = value;
    },

    save_items(value) {
      if (this.subcategory) {
        this.$refs.subcat.save_items(value);
      } else this.$refs.data.save_items(value);
    },

    Preview_image() {
      if (!this.category.image) this.url = null;
      if (this.category.image)
        this.url = URL.createObjectURL(this.category.image);
    }
  }
};
</script>
<style lang=""></style>
