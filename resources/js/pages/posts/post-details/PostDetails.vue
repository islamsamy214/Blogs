<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div class="col-12 w-100" v-else>
      <div class="card">
        <post-body :post="post"></post-body>
        <post-comment
          :post="post"
          @submitComment="submitComment"
        ></post-comment>
      </div>
    </div>
  </div>
</template>

<script>
import PostBody from "./PostBody.vue";
import PostComment from "./PostComment.vue";

export default {
  components: {
    PostBody,
    PostComment,
  }, //end of components

  data() {
    return {
      pageLoading: true,
      post: {},
    };
  }, //end of data

  methods: {
    fillPost() {
      axios
        .get("/api/posts/" + this.$route.params.id)
        .then((response) => {
          this.post = response.data;
        })
        .then(() => {
          this.pageLoading = false;
        });
    }, //end of filPost

    submitComment(formData) {
      this.isLoading = true;
      axios
        .post("/api/comments", formData)
        .then((response) => {
          if (response.status == 200) {
            location.reload();
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.isLoading = false;
        });
    }, //end of submit comment

    postUpdatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Comment Updated",
      }).show();
    }, //enf of Updated noty
  }, //end of methods

  created() {
    if (this.$route.params.id == "undefined") {
      this.$router.push({ name: "posts" });
    }
    if (this.$route.params.commentUpdated) {
      this.postUpdatedNotification();
    }

    this.fillPost();
  }, //end of created
};
</script>