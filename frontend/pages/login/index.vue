<template>
  <div>

<v-card 
    class="mx-auto"
    max-width="500"
    outlined align-center 
  >
    <v-list-item three-line >
      <v-list-item-content>
       
        <v-list-item-title class="text-h6 mb-1">
         <b>Login Form: </b> 
        </v-list-item-title>
          <v-form>
            <v-text-field
              v-model="login.email"
              label="Email"
              required
            ></v-text-field>

            <v-text-field
             :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required]"
            :type="show3 ? 'text' : 'password'"
            v-model="login.password"
            label="Not visible"
            
            
            class="input-group--focused"
            @click:append="show3 = !show3"
            ></v-text-field>

    

    

              <v-btn
                :disabled="!valid"
                color="success"
                class="mr-4"
                @click="userLogin"
              >
                Login
              </v-btn>

    
 
         </v-form>
 </v-list-item-content>
   </v-list-item >
  </v-card>   
  
   <!-- <form @submit.prevent="userLogin">
      <div>
        <label>Username</label>
        <input type="text" v-model="login.email" />
      </div>
      <div>
        <label>Password</label>
        <input type="text" v-model="login.password" />
      </div>
      <div>
        <button type="submit">Submit</button>
      </div>
    </form>-->
  </div>
</template>

<script>
export default {
  layout: "none",
  auth: "guest",
  data() {
    return {
      login: {
        email: "",
        password: "",
      },
      show3: false,
      valid: true,
      rules: {
          required: value => !!value || 'Required.',
          
          
        },
    };
  },
  methods: {

    
    async userLogin() {
      try {
        let response = await this.$auth.loginWith("local", {
          data: this.login,
        });
        console.log(response);
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>