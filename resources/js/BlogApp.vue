<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  props: ["user", "client"],

  created() {
    if (this.client && this.user) {
      this.$store.commit("webAuth/login", this.client);
      this.$store.commit("adminAuth/login", this.user);
    } else if (this.client) {
      this.$store.commit("webAuth/login", this.client);
    } else if (this.user) {
      this.$store.commit("adminAuth/login", this.user);
    } else {
      this.$store.commit("adminAuth/logout");
      this.$store.commit("webAuth/logout");
    }
  }, //end of created
};
</script>