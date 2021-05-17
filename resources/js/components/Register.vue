<template>
  <div class="main-register">
    
      <section class="register">
          <span>Cadastro</span>
          <form action="">
              <div class="form-itens">
                  <label for="name">Nome</label>
                  <input type="text" id="name" autocomplete="off" v-model="form.name">
              </div>
              <div class="form-itens">
                 <label for="name">Email</label>
                  <input type="email" id="email" placeholder="sophie@example.com" pattern=".+@globex.com" autocomplete="off" v-model="form.email" required>
              </div>
                <div class="form-itens">
                 <label for="name">Senha</label>
                  <input type="password" id="password" autocomplete="off" v-model="form.password" v-on:keyup="verificaForcaSenha">
                  <div class="prog-bar" id="prog"></div>
              </div>
          </form>
          <button @click.prevent="saveForm">Cadastrar</button>
        <small><router-link to="/Login">Faça login aqui!</router-link></small>
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
                name:'',
                email:'',
                password: ''
            }, 
            message:''
       
        }
    }, 
    methods:{
        saveForm(){
            if(this.form.passowrd === ''){
                this.showSnack('Preencha o campo senha');
                return;
            }
            if(this.form.email === ''){
                this.showSnack('Preencha o campo email');
                return;
            }
             if(this.form.name === ''){
                this.showSnack('Preencha o campo nome');
                return;
            }
           
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
                this.$router.push({ name: "Login"}); 
            }).catch((error) =>{
                console.log({error});
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
        },
        verificaForcaSenha(){
            var numeros = /([0-9])/;
            var alfabeto = /([a-zA-Z])/;
            var chEspeciais = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            let prog = document.getElementById('prog');

            if($('#password').val().length<6){
                $('#prog').removeClass();
                prog.classList.add('prog-bar');
                prog.classList.add('red'); 
            }else{
                if($('#password').val().match(numeros) && $('#password').val().match(alfabeto) && $('#password').val().match(chEspeciais)){       
                  $('#prog').removeClass();
                prog.classList.add('prog-bar');
                prog.classList.add('green'); 
                }else{
                $('#prog').removeClass();
                prog.classList.add('prog-bar');
                prog.classList.add('yellow'); 
                }
            }
            
        }
    },
    components:{
        Snackbar
    }

}
</script>

<style>
.main-register{
    margin: 50px;
    width: 590px;
    height: 598px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0px 0px 6px 3px rgb(171, 171, 171);
    display: flex;
    justify-content: center;
    font-family: 'Roboto', sans-serif;
}

.register{
 margin-top: 53px;
    width: 390px;
    height: 308px;
}
.form-itens{
    display: flex;
    flex-direction: column;
    padding-top: 30px;
}

.register button{
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

.register span{
    font-weight: bold;
    font-size: 30px;
    line-height: 35px;
}

.register form{
    margin-top: 35px;
}
.validade{
    font-size: 15px;
    position: absolute;
    margin: 5px 0px 5px 30px;
}

.prog-bar{
  height: 3px;
  margin-top: 5px;
  width: 95%;
  margin-left: 5px;
  border-radius: 10px;
   display: none;
  background-color: #ccc;
}

.red{
    display: flex;
    width: 15%;
    background-color:red;
}
.green{
    display: flex;
    width: 45%;
    background-color:green;
}
.yellow{
    display: flex;
    width: 30%;
    background-color:#ffbf0a;
}
</style>