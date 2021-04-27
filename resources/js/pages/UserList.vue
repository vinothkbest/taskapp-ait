<template>
  <div class="content">
    <div class="md-layout">
      <div
        class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100"
      >
        <md-card>
          <md-card-header data-background-color="green">
            <div class="d-flex justify-content-between">
                 <h4 class="title">Users</h4>
                 <router-link to="users/profile" v-if="has_admin">
                    <button type="button"
                            class="btn-warning">
                     Add User

                   </button>
                 </router-link>
            </div>  
          </md-card-header>
          <md-card-content>
            <user-table table-header-color="green"></user-table>

          </md-card-content>
        </md-card>
      </div>
    </div>
  </div>
</template>

<script>
import {UserTable} from "../components";
import swal from 'sweetalert';
export default {
  components: {
    UserTable
  },
  data(){
    return {
      has_admin: localStorage.getItem('admin-token')
    }
  },
  created(){
    if(sessionStorage.getItem('login')){
        swal({  title: "Admin Authentication",
                icon: 'success',
                text: sessionStorage.getItem('login'),
              });
        sessionStorage.removeItem('login')
    }
    if(sessionStorage.getItem('user-login')){
        swal({  title: "User Authentication",
                icon: 'success',
                text: sessionStorage.getItem('user-login'),
              });
        sessionStorage.removeItem('user-login')
    }
    if(sessionStorage.getItem('user')){
        swal({title: "User Add",
               icon: 'success',
               text: sessionStorage.getItem('user')
            })
        sessionStorage.removeItem('user')
    }
    if(sessionStorage.getItem('edit')){
        swal({title: "User Edit",
               icon: 'success',
               text: sessionStorage.getItem('edit')
            })
        sessionStorage.removeItem('edit')
    }
  }
};
</script>