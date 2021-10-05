<template lang="">
  <div>
    <v-row >
      <v-card color="#B3E5FC" class="width100 mb-6 pa-5"> <div class="max-width"> <v-icon color="orange"
   >mdi-animation</v-icon><b>{{subcat.category.name}}</b> 
    <span v-if="subcat.name" <v-icon>mdi-forward</v-icon> {{subcat.name}}</span></div> </v-card>
    </v-row>

    <li v-for="post in subcat.post" :key="post.id">
      <nuxt-link :to="{ name: 'post-post', params: { post: post.id } }">
        <v-card class="event-card">
          <v-layout row>
            <img
              src="https://images.unsplash.com/photo-1467139701929-18c0d27a7516?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=874439394c29dfb8f4b5a794a51a52f2&auto=format&fit=crop&w=750&q=80"
            />
            <v-layout
              column
              justify-space-between
              style="padding: 0.8em 1.3em; max-width: 700px;"
            >
              <div>
                <h3 class="name">{{ post.title }}</h3>
                
              </div>
              <div>
                <p class="desc">kiu</p>
                <div class="location">
                  <v-icon v-if="post.created_at">mdi-location_on</v-icon>
                  {{ post.created_at }}
                </div>
              </div>
              <!--	<div class="date-ribbon">
							<h2>09</h2>
							<h1>02</h1>
						</div>-->
            </v-layout>
          </v-layout>
        </v-card>
      </nuxt-link>
    </li>
  </div>
</template>
<script>
export default {
  layout: "frontend",
  async asyncData({ params, $axios }) {
    const category = params.category;

    const subcat = await $axios.$get("/api/subcategory/" + params.id);

    return { category,subcat };
  },

  data() {
    return {};
  },

  mounted() {}
};
</script>
<style lang=""></style>
