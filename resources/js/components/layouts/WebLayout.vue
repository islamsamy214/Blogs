<template>
  <div>
    <web-navbar></web-navbar>
    <div class="clearfix" style="height:3.5rem"></div>
    <div class="container-fluied">
      <router-view></router-view>
    </div>
    <web-footer></web-footer>
  </div>
</template>

<script>
import WebFooter from "../user-interface/web-ui/WebFooter.vue";
import WebNavbar from "./../navbars/WebNavbar.vue";
export default {
  components: {
    WebNavbar,
    WebFooter,
  }, //end of components

  async beforeRouteEnter(to, from, next) {
    //posts
    if (to.name == "posts") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }

    //posts.details
    if (to.name == "posts.details") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }
    if (to.name == "comments.edit") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }

    next();
  },

  async beforeRouteUpdate(to, from, next) {
    //posts
    if (to.name == "posts") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }

    //posts.details
    if (to.name == "posts.details") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }
    if (to.name == "comments.edit") {
      // check if authnticated
      try {
        const user = (await axios.get("/api/client")).data;
        next();
      } catch (error) {
        if (error.response.status == 401) {
          next({ name: "login" });
        }
      }
    }

    next();
  },
};
</script>