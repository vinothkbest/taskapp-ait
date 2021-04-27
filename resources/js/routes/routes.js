import Vue from "vue"
import VueRouter from "vue-router"
import DashboardLayout from "../pages/Layout/DashboardLayout.vue";

import Dashboard from "../pages/Dashboard.vue";
import UserProfile from "../pages/UserProfile.vue";
import EditProfileForm from "../pages/UserProfile/EditProfileForm.vue";
import UserList from "../pages/UserList.vue";
import AdminLogin from "../pages/AdminLogin.vue";
import UserLogin from "../pages/UserLogin.vue";
import App from "../App.vue";

const routes = [
  {
    path: "/",
    component: DashboardLayout,
    redirect: "/users",
    children: [
      {
        path: "users/profile",
        name: "User Profile",
        component: UserProfile,
        beforeEnter: (to, from, next) => {
	        if (localStorage.getItem("admin-token")||localStorage.getItem("user-token")) {
	        	next()
	        	return 
	        }
	        next("/admin-login")
	        return 
	      }
      },
      {
        path: "users/edit/:id",
        name: "EditProfileForm",
        component: EditProfileForm,
        beforeEnter: (to, from, next) => {
          if (localStorage.getItem("admin-token")||localStorage.getItem("user-token")) {
            next()
            return 
          }
          next("/admin-login")
          return 
        }
      },
      {
        path: "users",
        name: "Users List",
        component: UserList,
        beforeEnter: (to, from, next) => {
	        if (localStorage.getItem("admin-token")||localStorage.getItem("user-token")) {
	        	next()
	        	return 
	        }
	        next("/admin-login")
	        return 
	      }
      }
    ]
  },
  {
    path: "/admin-login",
    name: "AdminLogin",
    component: AdminLogin,
  },
  {
    path: "/user-login",
    name: "UserLogin",
    component: UserLogin,
  }
];

var router = new VueRouter({
    routes, // short for routes: routes
    linkExactActiveClass: "nav-item active"
});



export default router;