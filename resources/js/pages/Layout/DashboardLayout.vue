<template>
  <div class="wrapper" :class="{ 'nav-open': $sidebar.showSidebar }">
    <notifications></notifications>

    <side-bar
      :sidebar-item-color="sidebarBackground"
    >
      <mobile-menu slot="content"></mobile-menu>
      <sidebar-link to="/users">
        <p  v-if="has_admin"><i class="fa fa-user"></i>User Management</p>
        <p  v-if="!has_admin"><i class="fa fa-user"></i>User Lists</p>
      </sidebar-link>
      <!-- <sidebar-link to="/tasklist">
        <p><i class="fa fa-tasks"></i>Task Management</p>
      </sidebar-link> -->
    </side-bar>

    <div class="main-panel">
      <top-navbar></top-navbar>

      <dashboard-content> </dashboard-content>

      <content-footer v-if="!$route.meta.hideFooter"></content-footer>
    </div>
  </div>
</template>

<script>
import TopNavbar from "./TopNavbar.vue";
import ContentFooter from "./ContentFooter.vue";
import DashboardContent from "./Content.vue";
import MobileMenu from "./MobileMenu.vue";

export default {
  components: {
    TopNavbar,
    DashboardContent,
    ContentFooter,
    MobileMenu,
  },
  data() {
    return {
      sidebarBackground: "green",
      sidebarBackgroundImage: require("../../assets/img/sidebar-2.jpg"),
      has_admin: localStorage.getItem('admin-token')
    };
  }
};
</script>
