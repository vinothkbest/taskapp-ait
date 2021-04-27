<template>
  <form>
    <md-card>
      <md-card-header :data-background-color="dataBackgroundColor">
        <h4 class="title">Add User</h4>
      </md-card-header>

      <md-card-content>
              <div class="form-group">
                  <input
                      type="text"
                      class="form-control col-md-12"
                      v-model="name"
                      placeholder = "Enter user name"
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
                      placeholder = "Enter user mobile"
                      style="height:40px"
                      minlength="10"
                      maxlength="10">
              </div>
              <div class="form-group">
                  <input
                      type="text"
                      class="form-control col-md-12"
                      v-model="email"
                      placeholder = "Enter user email"
                      style="height:40px">
              </div>
              <div class="form-group">
                  <input
                      type="password"
                      class="form-control col-md-12"
                      v-model="password"
                      placeholder = "Enter user password"
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
export default {
  name: "edit-profile-form",
  props: {
    dataBackgroundColor: {
      type: String,
      default: ""
    }
  },
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
  },
  methods: {
    userSave(){
        let user = {
            gender:parseInt(this.gender),
            name:this.name,
            mobile:this.mobile,
            email:this.email,
            password:this.password,
        };
        console.log(user)
        const token = localStorage.getItem('admin-token')
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        axios({url: `${baseURL}/users/save`, data: user, method: 'POST' }).then(result => {
          sessionStorage.setItem('user', result.data.message)
          return this.$router.push('/users')
          
        }).catch(function(err){
          swal({
                 title: "User Add",
                 icon: 'error',
                 text: err.response.data.message
              })
        });
    }

  }
};
</script>
