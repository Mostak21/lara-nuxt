<template lang="">
  <div>
    <v-data-table
      :headers="headers"
      :items="posts"
      sort-by="id"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>My CRUD</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="850px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                New Item
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="text-h5">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col md="8" sm="12" xs="12">
                <v-text-field
                  label="Title"
                  v-model="editedItem.title"
                  
                  filled
                ></v-text-field>

                 <v-row>
              <v-col md="6" sm="12" xs="12">
                <v-select
                  label="Category"
                  v-model="editedItem.category"
                  :items="category"
                  item-text="name"
                  item-value="id"
                  
                  @change="fetch_subcategory(editedItem.category)"
                  
                  dense
                  solo
                ></v-select>
              </v-col>
              <v-col  md="6" sm="12" xs="12">
                <v-select
                  label="Sub Category"
                  v-model="editedItem.subcategory"
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
              <Editor v-model="editedItem.content"/>
              </v-col>
            </v-row>

              </v-col>
              <v-col md="4" sm="12" xs="12">

                <v-select
                      
                      label="State"
                      v-model="editedItem.state"
                      :items="state"
                      dense
                      solo
                    ></v-select>

                    <v-file-input
                  v-model="editedItem.thumbnail"
                 
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
                  v-model="editedItem.slag"
                  dense
                      solo
                ></v-text-field>


              </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="save">
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5"
                >Are you sure you want to delete this item?</v-card-title
              >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="closeDelete"
                  >Cancel</v-btn
                >
                <v-btn color="blue darken-1" text @click="deleteItemConfirm"
                  >OK</v-btn
                >
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>
      <template v-slot:item.content="{ item }">

        <div class="ellipsis"> <span class="ellipsis" v-html="item.content"></span></div>
       
    </template>
      <template v-slot:item.actions="{ item }">
        
        <v-hover>
<v-icon color="green lighten-1"small class="mr-2" @click="editItem(item)">
          mdi-pencil
        </v-icon>
        </v-hover>
        <v-icon color="red lighten-1" small @click="deleteItem(item)">
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize">
          Reset
        </v-btn>
      </template>
    </v-data-table>
  </div>
</template>
<script>
import Editor from "~/components/editor1";
export default {
    components: {
    Editor
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "TITLE",
        align: "start",
        sortable: false,
        value: "title"
      },
      { text: "Category", value: "category" },
      { text: "state", value: "state" },
       { text: "Content", value: "content" },
      { text: "Actions", value: "actions", sortable: false }
      
    ],
    posts: [],
    saving: [],
    category: [],
    subcategory: [],
    state: ["Public", "Pending", "Hide"],
    url: null,
    id: "",
    editedIndex: -1,
    editedItem: {
      title: null,
      category: null,
      subcategory: null,
      content: null,
      slag: null,
      thumbnail: [],
      image: null,
      state: null
    },
    defaultItem: {
      title: null,
      category: null,
      subcategory: null,
      content: null,
      slag: null,
      thumbnail: [],
      image: null,
      state: null
    }


  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    }
  },

  created() {
    this.initialize();
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
          this.subcategory = res;
        })
        .catch(err => {
          console.error(err);
        });
    },
    Preview_image() {
      if (!this.editedItem.thumbnail) this.url = null;
      if (this.editedItem.thumbnail)
        this.url = URL.createObjectURL(this.editedItem.thumbnail);
    },



    async initialize() {
      this.posts = await fetch("http://127.0.0.1:8000/api/post").then(res =>
        res.json()
      );
    },

    editItem(item) {
       item.thumbnail=[];
       this.fetch_subcategory(item.category);
      this.editedIndex = this.posts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.posts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.posts.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.posts[this.editedIndex], this.editedItem),
          (this.saving = this.$axios
            .$patch(
              "http://127.0.0.1:8000/api/post/" + this.editedItem.id,
              this.editedItem
            )
            .then(res => {
              console.log(res);
            }));
      } else {
        this.posts.push(this.editedItem),
          (this.id = this.editedItem.id),
          this.$axios
            .$post("http://127.0.0.1:8000/api/post", this.editedItem)
            .then(res => {
              console.log(res);
            });
      }
      this.close();
    }
  }
};
</script>
<style lang=""></style>
