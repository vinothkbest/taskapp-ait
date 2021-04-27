<template>
  <div class="content">
    <div class="md-layout">
      <div class="md-layout-item md-medium-size-100 md-size-66">
        <add-profile-form data-background-color="green"> </add-profile-form>
      </div>
    </div>
  </div>
</template>

<script>
import AddProfileForm from "./UserProfile/AddProfileForm.vue"

export default {
  components: {
    AddProfileForm
  }
};
</script>
