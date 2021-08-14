<template>
  <div>
    <admin-navbar></admin-navbar>
    <div class="container-fluid">
      <div class="row">
        <nav
          id="sidebarMenu"
          class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
        >
          <side-bar></side-bar>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
          <router-view></router-view>
        </main>
      </div>
    </div>
    <admin-footer></admin-footer>
  </div>
</template>

<script>
import AdminNavbar from "./../navbars/AdminNavbar.vue";
import AdminFooter from "../user-interface/admin-ui/AdminFooter.vue";
import SideBar from "../user-interface/admin-ui/SideBar.vue";

export default {
  components: {
    AdminNavbar,
    AdminFooter,
    SideBar,
  }, //end of components

  async beforeRouteEnter(to, from, next) {
    // check if authnticated
    try {
      const user = (await axios.get("/api/admin/user")).data;
      next();
    } catch (error) {
      if (error.response.status == 401) {
        next({ name: "admin.login" });
        // this.$router.push({ name: "admin-login" });
      }
    }
  },
};
</script>