<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <edit-form
      v-else
      :errors="errors"
      :isLoading="isLoading"
      :oldBody="oldBody"
      @submitComment="submitComment"
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
      oldBody: null,
      pageLoading: true,
      errors: null,
      isLoading: false,
    };
  }, //end of data

  methods: {
    fillData(id) {
      axios
        .get(`/api/comments/${id}/edit`, {
          params: { client_id: this.$route.params.clientId },
        })
        .then((response) => {
          this.oldBody = response.data.body;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          this.$router.push({ name: "posts" });
        });
    }, //end of fill data

    submitComment(formData) {
      axios
        .post(`/api/comments/${this.$route.params.id}`, formData)
        .then((response) => {
          if (response.status == 200) {
            this.$router.push({
              name: "posts.details",
              params: { commentUpdated: true, id: this.$route.params.postId },
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
      this.$router.push({ name: "posts" });
    }
    this.fillData(this.$route.params.id);
  }, //end of created

  beforeRouteEnter(to, from, next) {
    if (from.name == "posts.details") {
      next();
    } else {
      next({ name: "posts" });
    }
  }, //end of bforeCreate
};
</script>