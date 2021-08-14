<template>
  <div>
    <create-form
    :errors="errors"
    :isLoading="isLoading"
    @submitCategory="submitCategory"
    ></create-form>
  </div>
</template>
<script>
import CreateForm from './CreateForm.vue';
export default {
  components: { CreateForm },
  data() {
    return {
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    submitCategory(formData) {
      axios
        .post("/api/admin/categories", formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.categories",
              params: { categoryCreated: true },
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