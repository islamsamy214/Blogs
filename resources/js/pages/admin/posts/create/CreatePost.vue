<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <create-form
      v-else
      :errors="errors"
      :isLoading="isLoading"
      :categories="categories"
      @submitPost="submitPost"
    ></create-form>
  </div>
</template>
<script>
import CreateForm from "./CreateForm.vue";
export default {
  components: { CreateForm },

  data() {
    return {
      categories: [],
      errors: null,
      isLoading: false,
      pageLoading: true,
    };
  }, //end of data

  methods: {
    getCategories() {
      axios
        .get("/api/admin/posts/create")
        .then((response) => {
          this.categories = response.data;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.errors = errors.response.data;
        }); //end of axios request
    }, //end of getCategories

    submitPost(formData) {
      axios
        .post("/api/admin/posts", formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.posts",
              params: { postCreated: true },
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

  created(){
    this.getCategories();
  }//end of created
};
</script>