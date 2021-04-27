<template>
  <div>
    <md-table v-model="users" :table-header-color="tableHeaderColor">
      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="Name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="Gender">{{ item.gender }}</md-table-cell>
        <md-table-cell md-label="Mobile">{{ item.mobile }}</md-table-cell>
        <md-table-cell md-label="Email">{{ item.email }}</md-table-cell>
        <md-table-cell md-label="Action">
            <router-link :to="{path:'users/edit/'+item.id}" v-if="item.id == current_user||has_admin">
              <i class="fa fa-edit text-info"></i>
            </router-link>
            <i class="fa fa-trash text-danger ml-2 delete"
                @click="userDelete(item.id)" v-if="current_user ==''||has_admin"></i>
          </md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>

<script>
import axios from 'axios'
const token = localStorage.getItem('admin-token')||localStorage.getItem("user-token");
axios.defaults.headers.common.Authorization = `Bearer ${token}`
const baseURL = "http://localhost:8080/todolistapp/public/api"
      
export default {
  name: "lists",
  props: {
    tableHeaderColor: {
      type: String,
      default: ""
    }
  },
  data() {
    return {
      users: [
        {
          name: '',
          gender: '',
          mobile: '',
          email: ''
        }
      ],
      current_user:sessionStorage.getItem('current-user'),
      has_admin: localStorage.getItem('admin-token')
    };
  },
  created() {
   this.lists();
    console.log(this.$store.state.admin)
  },
  methods: {
    lists() {
        const url = localStorage.getItem('admin-token')? baseURL+'/users' : baseURL+'/users-list';  
      axios.get(url).then(res =>{
        return this.users = res.data.users;
      }).catch(error => {
       
      });
    },

    userDelete(id){
        axios.get(baseURL+"/users/delete/"+id).then(res =>{
            swal({title: "User delete",
                     icon: 'success',
                     text: "User deleted successfully"
                  })
            this.lists();
        }).catch(error => {
         
        });
    },
  },
};
</script>
<style>
  .delete{
    cursor: pointer;
  }
</style>