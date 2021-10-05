<template lang="">
  <div>
    <div class="pa-2  text-left primary">List:</div>
    <v-list-item
      v-for="item in catitems"
      :key="item.id"
      class="pl-3 mb-1 catborder"
    >
      <v-list-item-content>
        <v-list-item-title
          >{{ item.category.name }} ->{{ item.name }}
        </v-list-item-title>
      </v-list-item-content>
      <v-icon color="green darken-2" @click="edit_items(item.id)">mdi-circle-edit-outline</v-icon
      ><v-icon color="red darken-2" @click="delete_items(item.id)">mdi-delete-circle-outline</v-icon>
    </v-list-item>
  </div>
</template>
<script>
export default {
  data: () => ({
    eidted_cat: [],
    catitems: [],
    url: "http://127.0.0.1:8000/api/subcategory",

    data: {
      msg: "",
      snackbar: ""
    }
  }),

  mounted() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.$axios
        .$get(this.url)
        .then(res => {
          this.catitems = res;
        })
        .catch(err => {
          console.error(err);
        });
    },

    set_url(url) {
      this.url = url;
    },

    //  edit_items(e) {

    // },
    delete_items(e) {
      this.$axios
        .$delete(this.url + "/" + e)
        .then(res => {
          this.fetch();

          this.data.msg = res;
          this.data.snackbar = true;

          this.$emit("clicked", this.data);
        })
        .catch(err => {
          console.error(err);
        });
    },

    edit_items(e) {
      this.$axios
        .$get(this.url + "/" + e + "/edit")
        .then(res => {
          this.$emit("cat_edited", res);
        })
        .catch(err => {
          console.error(err);
        });
      this.$emit("subcat", true);
      this.$emit("dialoguechange", true);
    },

    save_items(e) {
      this.$axios
        .$put(this.url + "/" + e.id, e)
        .then(res => {
          this.fetch();
          this.$emit("dialoguechange", false);
          this.data.msg = res;
          this.data.snackbar = true;

          this.$emit("clicked", this.data);
        })
        .catch(err => {
          console.error(err);
        });
    }
  }
};
</script>
<style lang=""></style>
