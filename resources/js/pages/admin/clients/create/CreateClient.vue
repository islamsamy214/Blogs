<template>
  <div>
    <create-form
      :errors="errors"
      :isLoading="isLoading"
      @submitClient="submitClient"
    ></create-form>
  </div>
</template>
<script>
import CreateForm from "./CreateForm.vue";

export default {
  components: {
    CreateForm,
  },

  data() {
    return {
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    submitClient(formData) {
      axios
        .post("/api/admin/clients", formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.clients",
              params: { clientCreated: true },
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
};
</script>