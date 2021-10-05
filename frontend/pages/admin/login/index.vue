<template lang="">
    <div>
        
          <v-card 
    class="mx-auto"
    max-width="500"
    outlined align-center 
  >

        <v-list-item-title class="pa-md-4 mx-lg-auto">
         <b>Login Form: </b> 
        </v-list-item-title>
    <v-list-item three-line >
      <v-list-item-content class="pa-md-4 mx-lg-auto">
       
        
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
            solo
            prepend-inner-icon="mdi-email"
      v-model="login.email"
      :counter="10"
      :rules="emailRules"
      label="Email"
      required
    ></v-text-field>

    <v-text-field
    solo
            prepend-inner-icon="mdi-form-textbox-password"
      v-model="login.password"
      :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
      :type="show3 ? 'text' : 'password'"
      :rules="passwordRules"
      label="Password"
      @click:append="show3 = !show3"
      class="input-group--focused"
      required
    ></v-text-field>

    

    <v-checkbox
      v-model="checkbox"
      :rules="[v => !!v || 'You must agree to continue!']"
      label="Do you agree?"
      required
    ></v-checkbox>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="userLogin"
    >
      Login
    </v-btn>
  

<nuxt-link to="/admin/signup">
   <v-btn
      
      color="primary"
      class="mr-4"
      @click="userLogin"
    >
      Signup
    </v-btn>
</nuxt-link>
   

    
  </v-form>
  </v-list-item-content>
   </v-list-item >
  </v-card> 

    </div>
</template>
<script>
export default {
  layout: "none",
  middleware: 'auth',
    auth : 'guest',
    data: () => ({
      valid: true,
      
     login: {
        email: "",
        password: "",
      },
      show3: false,
      
      passwordRules: [
        v => !!v || 'Password is required',
        v => (v && v.length >= 6) || 'Password must be more than 6 characters',
      ],
      
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      
     
      checkbox: false,
    }),

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
  

      validate () {
        this.$refs.form.validate()
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
    },
}
</script>
<style lang="">
    
</style>