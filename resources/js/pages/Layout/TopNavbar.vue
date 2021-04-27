<template>
  	<div>
  		<md-list>
  			<md-list-item @click="logout">
              <i class="fa fa-sign-out"></i>
              Logout
            </md-list-item>
  		</md-list>
	</div>
</template>
<script>
	export default{
         methods : {
         	logout(){
            if(localStorage.getItem('admin-token')){
           		this.$store.dispatch('AdminLogout').then((response)=>{
                  sessionStorage.setItem('logout', response.data.message)
  	              this.$router.push("/admin-login")
  	            });
            }
            else if(localStorage.getItem('user-token')){
              this.$store.dispatch('UserLogout').then((response)=>{
                  sessionStorage.setItem('user-logout', response.data.message)
                  this.$router.push("/user-login")
                });
            }
         	}
         }
	};
</script>