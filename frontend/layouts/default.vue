<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
      <v-list>
        <v-list-item>
          <v-list-item-icon>
            <v-icon></v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <nuxt-link to="/">
              <v-list-item-title>Home</v-list-item-title></nuxt-link
            >
          </v-list-item-content>
        </v-list-item>

        <v-list-group
          v-for="item in items"
          :key="item.title"
          v-model="item.active"
          
          no-action
          :append-icon="item.a_icon"
        >  
          <v-icon slot="prependIcon" :color="item.color">{{item.action}}</v-icon>
          <template v-slot:activator>
            <v-list-item-content>
              <nuxt-link v-if="!item.items" :to="item.to">
               <v-list-item-title v-text="item.title"></v-list-item-title
              ></nuxt-link>
              <v-list-item-title v-if="item.items" v-text="item.title"></v-list-item-title>
            </v-list-item-content>
          </template>
          
          <v-list-item  v-for="child in item.items" :key="child.title">

            <v-list-item-content >
              <nuxt-link :to="child.to">
                <v-list-item-title v-text="child.title"></v-list-item-title
              ></nuxt-link>
            </v-list-item-content>
          </v-list-item>
          
        </v-list-group>

        <v-list-item >
          <v-list-item-icon>
            <v-icon >mdi-logout</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <nuxt-link to="/">
              <v-list-item-title  @click="logout">Logout</v-list-item-title></nuxt-link
            >
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <!--  -->
    </v-navigation-drawer>

    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
<h4 v-if="loggedIn">hello</h4>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container fluid>
        
      <Nuxt/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    items: [
      {
        action: "mdi-ticket",
        items: [
          { title: "All Post", to: "/admin/post" },
          { title: "Add Post", to: "/admin/post/create" }
        ],
        title: "Post",
        color:"green"
         
      },

       {
        action: "mdi-ticket",
        
        title: "2nd post",
        to: "/admin/post/create",
        a_icon: null

      },
        {
        action: "mdi-ticket",
        
        title: "Category",
        to: "/admin/category",
        a_icon: null

      },
      {
        action: "mdi-silverware-fork-knife",
        active: false,
        items: [
          { title: "All User", to: "/admin/user" },
          { title: "Add New User", to: "/admin/user/create" }
        ],
        title: "User",
       
      },

      

    ]
  }),

computed:{

 loggedIn(){
  return this.$store.state.auth.loggedIn
 }
}
,
  methods: {
    async logout() {
           return this.$auth.logout();
    }
    ,
   
}

    
  }

</script>
<style scoped>
a:link {
  color: black;
  font-weight: none;
  font-style: none;
  text-decoration: none;
}

/* visited link */
a:visited {
  color: black;
}

/* mouse over link */
a:hover {
  color: black;

  font-weight: bold;
}

/* selected link */
a:active {
  color: blue;
}
</style>
