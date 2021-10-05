<template>
  <v-container>
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
    <v-form @submit.prevent>
      <v-row>
        <v-col  md="12" sm="12" xs="12">
          <v-card class="pa-5">
            <v-row>
              <v-col md="8" sm="12" xs="12">
                <v-text-field
                  label="Title"
                  v-model="post.title"
                  :rules="[rules.required]"
                  filled
                ></v-text-field>

                 <v-row>
              <v-col md="6" sm="12" xs="12">
                <v-select
                  label="Category"
                  v-model="post.category"
                  :items="category"
                  item-text="name"
                  item-value="id"
                  @change="fetch_subcategory(post.category)"
                  dense
                  solo
                ></v-select>
              </v-col>
              <v-col  md="6" sm="12" xs="12">
                <v-select
                  label="Sub Category"
                  v-model="post.subcategory"
                  :items="subcategory"
                  item-text="name"
                  item-value="id"
                  dense
                  solo
                ></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col  md="12" sm="12" xs="12">
                <Editor v-model="post.content"/>
              </v-col>
            </v-row>

              </v-col>
              <v-col md="4" sm="12" xs="12">

                <v-select
                      v-if="subcategory" 
                      label="State"
                      v-model="post.state"
                      :items="state"
                      dense
                      solo
                    ></v-select>

                    <v-file-input
                  v-model="post.thumbnail"
                 
                  label="Select Thumbnail "
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

                <v-text-field
                  label="Slag"
                  v-model="post.slag"
                  dense
                      solo
                ></v-text-field>


              </v-col>
            </v-row>

            

           
            
            <v-btn
              color="secondary"
              elevation="2"
              class="mt-4"
              type="submit"
              @click="submit"
            >
              ADD Post</v-btn
            >
          </v-card>
        </v-col>
        <v-col md="4">
          <v-card> </v-card>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script>
import Editor from "~/components/editor1";
export default {
  components: {
    Editor
  },
  data: () => ({
    post: {
      title: null,
      category: null,
      subcategory: null,
      content: null,
      slag: null,
      thumbnail: [],
      image: null,
      state: null
    },

    category: [],
    subcategory: [],
    state: ["Public", "Pending", "Hide"],
    url: null,
    msg: "",
    snackbar: false,

    rules: {
      required: value => !!value || "Please fill up the box",
      title: value => !!value || "Required.",
      content: value => !!value || "Required."
    },
    
    err: []
  }),

  mounted() {
    this.fetch_category();
  },

  methods: {
    fetch_category() {
      this.$axios
        .$get("/api/category")
        .then(res => {
          this.category = res;
        })
        .catch(err => {
          console.error(err);
        });
    },
    fetch_subcategory(id) {
      this.$axios
        .$get("/api/category/" + id)
        .then(res => {
          this.subcategory = res.subcategory;
        })
        .catch(err => {
          console.error(err);
        });
    },

    submit() {
      this.$axios
        .$post("http://127.0.0.1:8000/api/post", this.post)
        .then(res => {
          this.msg = res;
          this.snackbar=true;
        });
    },
     Preview_image() {
      if (!this.category.image) this.url = null;
      if (this.category.image)
        this.url = URL.createObjectURL(this.category.image);
    }
  }
};
</script>
