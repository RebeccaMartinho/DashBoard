<template>
  <div class="main-login">
      <section class="login">
          <span>Login</span>
          <form action="">
              <div class="form-itens">
                  <label for="email">Email</label>
                  <input type="text" id="email" v-model="form.email">
              </div>
                <div class="form-itens">
                  <label for="password">Senha</label>
                  <input type="password" id="password" v-model="form.password">
              </div>

          </form>
           <button @click.prevent="loginUser">Enviar</button>
          <small><router-link to="/Register">Register</router-link></small>
          <Snackbar :text="message"></Snackbar>
      </section>
  </div>
</template>

<script>
import Snackbar from './SnackBar';
export default {
    data(){
        return{
            form:{
                email: '',
                password: '',
                device_name: 'browser'
            },
            message:''
        }
    },
    methods:{
         loginUser(){
            if(this.form.passowrd === ''){
                this.showSnack('Preencha o campo senha');
                return;
            }
            if(this.form.email === ''){
                this.showSnack('Preencha o campo email');
                return;
            }
            axios.post('/api/login', this.form).then((resp) =>{
                 localStorage.setItem('token', resp.data);
             }).then((resp)=>{
                   this.$router.push({ name: "Dashboard"}); 
             }).catch((error) =>{
                 console.log({error})
                 this.showSnack(error.response.data.error)
            })
         },
          showSnack(message){
            this.message = message;
            var x = document.getElementById("snackbar");

             x.classList.add("show");
            setTimeout(()=>{
               x.classList.remove("show");
            }, 2500)
        }
    },
    components:{
        Snackbar

    }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap');

.main-login{
    margin: 50px;
    width: 590px;
    height: 598px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0px 0px 6px 3px rgb(171, 171, 171);
    display: flex;
    justify-content: center;
    /* align-items: center; */
    font-family: 'Roboto', sans-serif;
}

.login{
    margin-top: 53px;
    width: 390px;
    height: 308px;
}

.login span{
    font-weight: bold;
    font-size: 30px;
    line-height: 35px;
}

.login form{
    margin-top: 35px;
}

.form-itens input{
    width: 386px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid #A3A3A3;
    padding: 10px;
}

.form-itens input:focus-visible{
    border: 1px solid #47bbdf !important;
}

*:focus{
    outline: none;
}

.login button{
    border: 1px solid #ccc;
    margin-top: 51px;
    display: flex;
    justify-content: center;
 
    align-items: center;
   
    color: white;
    width: 127px;
    height: 37px;
    background: #4D90AF;
    border-radius: 4px;
}
</style>