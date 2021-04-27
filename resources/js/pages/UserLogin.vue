<template>
    <div>
      <div class="login-page">
          <div class="form">
              <div class="social">
                  <a href="">
                    <button class="btn btn-primary btn-block">User</button>
                  </a>
                  <br>
              </div>
              <form class="login-form mt-4">
                  <input type="text" placeholder="email" v-model="user.email"/>
                  <input type="password" placeholder="password" v-model="user.password"/>
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
    name:"UserLogin",
    data(){
      return {
        user:{
          email:'',
          password:'',
        }
      }
    },
    created(){
      if(sessionStorage.getItem('user-logout')){

        swal({  title: "User Authentication",
                icon: 'success',
                text: sessionStorage.getItem('user-logout'),
              });
        sessionStorage.removeItem('user-logout')
      }
    },
    methods:{
        auth(){
           this.$store.dispatch('UserLogin', this.user).then(()=>{
              this.$router.push("/users")
            }).catch(function(error){
                swal({
                     title: "User Authentication",
                     icon: 'error',
                     text: error.response.data.message
                  })
            });

        }
    }
  };

</script>
