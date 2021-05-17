<template>
    <div class="main-dashboard" v-if="user">
        <section class="dashboard">
            
              <span> Olá {{user.name}}, seja bem vindo(a).</span>
               
                <button @click.prevent="logout">Logout</button>
           
        </section>
       

    </div>
</template>
<script>
export default {
    data(){
        return{
            user: null,
            token: localStorage.getItem('token')
        }
    },
    methods:{
        logout(){
            axios.post('/api/logout').then(()=>{
                localStorage.removeItem('token');
                this.$router.push({ name: "Login"})
            })
        }
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        axios.get('/api/user').then((res)=>{
            this.user = res.data
        }).catch(err=>{
            console.log(err);
            this.$router.push({ name: "Login"})
        })
    }
}
</script>
<style >
.main-dashboard{
    margin: 50px;
    width: 1090px;
    height: 598px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0px 0px 6px 3px rgb(171, 171, 171);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Roboto', sans-serif;
}

.dashboard{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.dashboard button{
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
.dashboard span{
    font-size: 50px;
}
</style>