<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <edit-form
      v-else
      :errors="errors"
      :isLoading="isLoading"
      :oldName="oldName"
      @submitCategory="submitCategory"
    ></edit-form>
  </div>
</template>
<script>
import EditForm from "./EditForm.vue";

export default {
  components: {
    EditForm,
  }, //end of components

  data() {
    return {
      oldName: null,
      pageLoading: true,
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    fillData(id) {
      axios
        .get(`/api/admin/categories/${id}/edit`)
        .then((response) => {
          this.oldName = response.data.name;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    }, //end of fill data

    submitCategory(formData) {
      axios
        .post(`/api/admin/categories/${this.$route.params.id}`, formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.categories",
              params: { categoryUpdated: true },
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
      this.$router.push({ name: "admin.categories" });
    }
    this.fillData(this.$route.params.id);
  }, //end of created

  beforeRouteEnter(to, from, next) {
    if (from.name == "admin.categories") {
      next();
    } else {
      next({ name: "admin.categories" });
    }
  }, //end of bforeCreate
};
</script>