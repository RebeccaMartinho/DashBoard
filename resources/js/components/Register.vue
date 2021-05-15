<template>
  <div class="main-register">
    
      <section class="register">
          <span>Cadastro</span>
          <form action="">
              <div class="form-itens">
                  <label for="name">nome</label>
                  <!-- <span class="errors" v-if="errors.name">{{errors.name[0]}}</span> -->
                  <input type="text" id="name" autocomplete="off" v-model="form.name">
              </div>
              <div class="form-itens">
                 <label for="name">email</label>
                  <!-- <span class="errors" v-if="errors.email">{{errors.email[0]}}</span> -->
                  <input type="text" id="email" autocomplete="off" v-model="form.email">
              </div>
                <div class="form-itens">
                 <label for="name">senha</label>
                  <input type="text" id="password" autocomplete="off" v-model="form.password">
              </div>
          </form>
          <button @click.prevent="saveForm">Cadastrar</button>
      </section>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                name:'',
                email:'',
                password: ''
            }, 
       
        }
    }, 
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }

}
</script>

<style>
.main-register{
    position: absolute;
    width: 590px;
    height: 598px;
    border: 1px solid red;
    display: flex;
    justify-content: center;
    align-items: center;
    
}

.register{
 border: 1px solid red;
 width: 70%;
 height: 70%;
}
.form-itens{
    display: flex;
    flex-direction: column;
}
</style>