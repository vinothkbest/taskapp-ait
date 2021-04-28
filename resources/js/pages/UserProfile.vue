<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-100 md-size-66">
        <add-profile-form data-background-color="green" v-if="is_admin"> </add-profile-form>
        <edit-profile-form data-background-color="green" v-if="is_user"> </edit-profile-form>
      </div>
    </div>
  </div>
</template>

<script>
import AddProfileForm from "./UserProfile/AddProfileForm.vue"
import EditProfileForm from "./UserProfile/EditProfileForm.vue"
export default {
  components: {
    AddProfileForm,
    EditProfileForm,
  },
  data(){
    return{
      is_admin: localStorage.getItem('admin-token'),
      is_user: localStorage.getItem('user-token'),
    }
  }
};
</script>
