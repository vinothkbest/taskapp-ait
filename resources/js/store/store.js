import Vue from "vue"
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex);
const baseURL = 'http://localhost:8080/todolistapp/public/api'
const store = new Vuex.Store({
	state:{
		status:"",
		token: localStorage.getItem('admin-token')||"",
		admin: "",
	},
	actions:{
		async AdminLogin({commit}, credential){
	        return await new Promise((resolve, reject)=>{
          	axios({url: `${baseURL}/admin-login`, data: credential, method: 'POST' })
            .then(resp => {
             	if(resp.data.status == "success"){
             		const token = resp.data.token
             		localStorage.setItem('admin-token', token)
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                sessionStorage.setItem('login', 'Login successfully')
                const admin = resp.data.admin
             		commit('logged',token,admin)
                resolve(resp)
             	}
            }).catch(function(err){
              	commit('invalid')
              	reject(err)
            })
          })
		},
		async AdminLogout({commit}){
		  const token = localStorage.getItem('admin-token')
      return await new Promise((resolve, reject)=>{
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
      	axios({url: `${baseURL}/admin-logout`, method: 'GET' })
        .then(resp => {
         	if(resp.data.status == "success"){
            delete axios.defaults.headers.common.Authorization
            localStorage.removeItem("admin-token")
            commit('logout')
            resolve(resp)
         	}
        }).catch(err => {
           commit('invalid')
        	 reject(err)
        })
      })
		},
    async UserLogin({commit}, credential){
          return await new Promise((resolve, reject)=>{
            axios({url: `${baseURL}/user-login`, data: credential, method: 'POST' })
            .then(resp => {
              if(resp.data.status == "success"){
                const token = resp.data.token
                localStorage.setItem('user-token', token)
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                sessionStorage.setItem('user-login', 'Login successfully')
                sessionStorage.setItem('current-user', resp.data.user.id)
                const user = resp.data.user
                commit('logged',token,user)
                resolve(resp)
              }
            }).catch(function(err){
                commit('invalid')
                reject(err)
            })
          })
    },
    async UserLogout({commit}){
      const token = localStorage.getItem('user-token')
      return await new Promise((resolve, reject)=>{
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        axios({url: `${baseURL}/user-logout`, method: 'GET' })
        .then(resp => {
          if(resp.data.status == "success"){
            delete axios.defaults.headers.common.Authorization
            localStorage.removeItem("user-token")
            sessionStorage.removeItem('current-user')
            commit('logout')
            resolve(resp)
          }
        }).catch(err => {
           commit('invalid')
           reject(err)
        })
      })
    },
	},
	mutations:{
		logged(state,token,user){
			state.status = true
			state.token = token
			state.admin = user
		},
		invalid(state){
      localStorage.removeItem("token")
			state.status = false
			state.token = ""
			state.admin = ""
		},
    logout(state){
      state.status = false
      state.token = ""
      state.admin = ""
    }
	},

});

export default store;

