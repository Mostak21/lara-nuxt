<template lang="">
  <div>
    <v-row>
      <v-card color="#B3E5FC" class="width100 mb-6 pa-5">
        <div class="max-width">
          <v-icon color="orange">mdi-animation</v-icon>
          <b>{{ post.cat.name }}</b>

          <span v-if="post.subcat.name">
            <v-icon>mdi-forward</v-icon> {{ post.subcat.name }}</span
          >
        </div>
      </v-card>
    </v-row>

    <v-row>
      <v-card class="post-card">
        <v-row>
          <h1 class="name mb-5">{{ post.title }}</h1>
          </v-row>

        <v-row justify="center">
          <v-img
            :aspect-ratio="16 / 9"
            max-height="300"
            max-width="500"
            src="https://images.unsplash.com/photo-1467139701929-18c0d27a7516?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=874439394c29dfb8f4b5a794a51a52f2&auto=format&fit=crop&w=750&q=80"
          ></v-img>
        </v-row>


        <v-row> <div class="post-line my-6"></div> </v-row>


        <v-row>
        <span v-html="post.content"> </span>
        </v-row>

        <!--	<div class="date-ribbon">
							<h2>09</h2>
							<h1>02</h1>
						</div>-->
      </v-card>
    </v-row>
    <v-row>
      <v-card class="post-card my-6" color="geay"
        >     
        
        <comments :id="post.id" :comment="post.comment"></comments
      ></v-card>
    </v-row>
  </div>
</template>
<script>
import comments from "~/components/frontend/comments";
export default {
  components: {
    comments
  },
  layout: "frontend",
  async asyncData({ params, $axios }) {
    const category = params.category;

    const post = await $axios.$get("api/post/" + params.post);

    return { category, post };
  },

  data() {
    return {};
  },

  mounted() {}
};
</script>
<style lang=""></style>
