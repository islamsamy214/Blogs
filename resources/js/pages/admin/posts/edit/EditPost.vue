<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <edit-form
      v-else
      :oldTitle="oldTitle"
      :oldBody="oldBody"
      :oldCategoryId="oldCategoryId"
      :categories="categories"
      :errors="errors"
      :isLoading="isLoading"
      @submitPost="submitPost"
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
      oldTitle: null,
      oldBody: null,
      oldCategoryId: null,
      categories: [],
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    fill(id) {
      axios
        .get(`/api/admin/posts/${id}/edit`)
        .then((response) => {
          this.oldTitle = response.data[0].title;
          this.oldBody = response.data[0].body;
          this.oldCategoryId = response.data[0].category_id;
          this.categories = response.data[1];
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          this.$router.push({ name: "admin.posts" });
        });
    }, //end of fill data

    submitPost(formData) {
      axios
        .post(`/api/admin/posts/${this.$route.params.id}`, formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "admin.posts",
              params: { postUpdated: true },
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
      this.$router.push({ name: "admin.posts" });
    }
    this.fill(this.$route.params.id);
  }, //end of created

  beforeRouteEnter(to, from, next) {
    if (from.name == "admin.posts.details") {
      next();
    } else {
      next({ name: "admin.posts" });
    }
  }, //end of bforeCreate
};
</script>