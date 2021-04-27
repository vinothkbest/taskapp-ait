<template>
    <div>
      <div class="login-page">
          <div class="form">
              <div class="social">
                  <a href="">
                    <button class="btn btn-danger btn-block">Admin</button>
                  </a>
                  <br>
              </div>
              <form class="login-form mt-4">
                  <input type="text" placeholder="email" v-model="admin.email"/>
                  <input type="password" placeholder="password" v-model="admin.password"/>
                  <button type="button" class="login-btn" @click="auth()">login</button>
                  <br>
              </form>
          </div>
        </div>
    </div>
</template>
<script>
  import "../assets/login.css";
  import swal from 'sweetalert';
  export default{
    name:"AdminLogin",
    data(){
      return {
        admin:{
          email:'',
          password:'',
        }
      }
    },
    created(){
      if(sessionStorage.getItem('logout')){

        swal({  title: "Admin Authentication",
                icon: 'success',
                text: sessionStorage.getItem('logout'),
              });
        sessionStorage.removeItem('logout')
      }
    },
    methods:{
        auth(){
           this.$store.dispatch('AdminLogin', this.admin).then(()=>{
              this.$router.push("/users")
            }).catch(function(error){
                swal({
                     title: "Admin Authentication",
                     icon: 'error',
                     text: error.response.data.message
                  })
            });

        }
    }
  };

</script>
