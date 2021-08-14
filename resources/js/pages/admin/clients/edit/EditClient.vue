<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <edit-form
      v-else
      :errors="errors"
      :isLoading="isLoading"
      :oldName="oldName"
      :oldEmail="oldEmail"
      @submitClient="submitClient"
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
      oldName: null,
      oldEmail: null,
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    fill(id) {
      axios
        .get(`/api/admin/clients/${id}/edit`)
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
    },

    submitClient(formData) {
      axios
        .post(`/api/admin/clients/${this.$route.params.id}`, formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.clients",
              params: { clientUpdated: true },
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
      this.$router.push({ name: "admin.clients" });
    }
    this.fill(this.$route.params.id);
  }, //end of created

  beforeRouteEnter(to, from, next) {
    if (from.name == "admin.clients") {
      next();
    } else {
      next({ name: "admin.clients" });
    }
  }, //end of bforeCreate
};
</script>