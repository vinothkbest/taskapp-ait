<template>
  <form>
    <md-card>
      <md-card-header>
        <h4 class="title">Edit User</h4>
      </md-card-header>

      <md-card-content>
              <div class="form-group">
                  <input
                      type="text"
                      class="form-control col-md-12"
                      v-model="name"
                      placeholder = "Edit user name"
                      style="height:40px">
              </div>
              <div class="form-group">
                  <input type="radio" id="male" v-model="gender" name="gender" value=1>
                  <label for="male">Male</label><br>
                  <input type="radio" id="female" v-model="gender" name="gender" value=0>
                  <label for="female">Female</label><br>
              </div>
              <div class="form-group">
                  <input
                      type="text"
                      class="form-control col-md-12"
                      v-model="mobile"
                      placeholder = "Edit user mobile"
                      style="height:40px"
                      minlength="10"
                      maxlength="10">
              </div>
              <div class="form-group">
                  <input
                      type="text"
                      class="form-control col-md-12"
                      v-model="email"
                      placeholder = "Edit user email"
                      style="height:40px">
              </div>
              <div class="form-group">
                  <input
                      type="password"
                      class="form-control col-md-12"
                      v-model="password"
                      placeholder = "Edit user password"
                      style="height:40px">
              </div>
              <div class="form-group" @click="userSave">
                  <button
                      type="button"
                      class="btn btn-primary col-md-12"
                      style="height:40px"
                      >Save</button>
              </div>
              <label class="text-danger w-100 animated FadeIn">{{ message }}</label>
      </md-card-content>
    </md-card>
  </form>
</template>
<script>
import axios from 'axios'
import swal from 'sweetalert';
const baseURL = 'http://localhost:8080/todolistapp/public/api'
const token = localStorage.getItem('admin-token')||localStorage.getItem('user-token')
axios.defaults.headers.common.Authorization = `Bearer ${token}`
export default {
  name: "EditProfileForm",
  data() {
    return {
      name: '',
      email:'',
      mobile: '',
      password:'',
      gender:'',
      message: '', 
    };
  },
  created() {
       this.userEdit();
  },
  methods: {
    async userEdit() {
      if(localStorage.getItem('admin-token')){
        var url = `${baseURL}/users/edit/${this.$route.params.id}`
      }
      if(localStorage.getItem('user-token')){
        var url = `${baseURL}/user-edit/${this.$route.params.id}`
      }
      await axios.get(url).then(res =>{
        this.name = res.data.user.name;
        this.email = res.data.user.email;
        this.mobile = res.data.user.mobile;
        this.gender = (res.data.user.gender =='Male')?1:0;

      }).catch(error => {
       
      });
    },

    userSave(){
      if(this.password != ''){
        var user = {
            gender:parseInt(this.gender),
            name:this.name,
            mobile:this.mobile,
            email:this.email,
            password:this.password,
        };
      }
      else{
        var user = {
            gender:parseInt(this.gender),
            name:this.name,
            mobile:this.mobile,
            email:this.email,
        };
      }
        
        if(localStorage.getItem('admin-token')){
          var url = `${baseURL}/users/update/${this.$route.params.id}`
        }
        if(localStorage.getItem('user-token')){
          var url = `${baseURL}/user-update/${this.$route.params.id}`
        }
        axios({url: url, data: user, method: 'POST' }).then(result => {
          sessionStorage.setItem('edit', result.data.message)
          return this.$router.push('/users')
          
        }).catch(function(err){
          swal({
                 title: "User Edit",
                 icon: 'error',
                 text: err.response.data.message
              })
        });
    }

  }
};
</script>
