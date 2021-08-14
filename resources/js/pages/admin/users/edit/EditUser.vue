<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <edit-form 
    v-else
    :oldName="oldName"
    :oldEmail="oldEmail"
    :errors="errors"
    :isLoading="isLoading"
    @submitUser="submitUser"
    ></edit-form>
  </div>
</template>
<script>
import EditForm from "./EditForm.vue";

export default {
  components: { EditForm },

  data() {
    return {
      pageLoading: true,
      oldName:null,
      oldEmail:null,
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    fill(id) {
      axios
        .get(`/api/admin/users/${id}/edit`)
        .then((response) => {
          this.oldName = response.data.name;
          this.oldEmail = response.data.email;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },//end of fill data

    submitUser(formData) {
      axios
        .post(`/api/admin/users/${this.$route.params.id}`, formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.users",
              params: { userUpdated: true },
            });
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.isLoading = false;
        });
    }, //end of submtting the form
  }, //end of mehtods

  created() {
    if (this.$route.params.id == "undefined") {
      this.$router.push({ name: "admin.users" });
    }
    this.fill(this.$route.params.id);
  }, //end of created

  beforeRouteEnter(to, from, next) {
    if (from.name == "admin.users") {
      next();
    } else {
      next({ name: "admin.users" });
    }
  }, //end of bforeCreate
};
</script>