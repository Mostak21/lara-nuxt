<template>
  <section>
    <h1 class="display-1">
      Tiptap Vuetify
    </h1>
<form @submit.prevent>
 <Editor />
 <button type="submit" @click="submit">submit</button>
</form>
    
  </section>
</template>

<script>
import Editor from '../components/Editor'

export default {
  components: {
    Editor
  },
  layout:'frontend',
  data(){
    return{
      info: '',
    }
  }
  ,

  mounted() { 
    //console.log(this.$refs.content.content);
  },
  methods: {
    submit(){
      console.log(this.content);
     // console.log(this.$refs.content.content);
    }
  },
}
</script>

