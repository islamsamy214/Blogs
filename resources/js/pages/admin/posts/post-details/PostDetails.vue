<template>
  <div>
    <page-header>Posts</page-header>
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
    submitComment(formData) {
      this.isLoading = true;
      axios
        .post("/api/admin/comments", formData)
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
    axios
      .get("/api/admin/posts/" + this.$route.params.id)
      .then((response) => {
        this.post = response.data;
      })
      .then(() => {
        this.pageLoading = false;
      });

    if(this.$route.params.commentUpdated){
      this.postUpdatedNotification();
    }
  }, //end of created
};
</script>