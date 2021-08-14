<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div
      v-else
      class="comment px-3 py-2"
      v-for="comment in comments"
      :key="comment.id"
    >
      <h6 class="card-title" v-if="comment.user">
        <img
          :src="comment.user.image_path"
          class="img-thumbnail"
          style="max-width: 40px"
        />
        <p class="d-inline">
          {{ comment.user.name }} <span class="badge badge-primary">Admin</span>
        </p>
        <div class="handle d-inline float-right">
          <button
            class="btn btn-danger mb-1 ml-1"
            @click="deleteComment(comment.id)"
          >
            Delete
          </button>
          <router-link
            class="btn btn-warning mb-1 ml-1"
            :to="{ name: 'admin.comments.edit', params: { id: comment.id, postId: comment.post_id } }"
            >Edit</router-link
          >
          <router-link
            class="btn btn-primary mb-1 ml-1"
            :to="{
              name: 'admin.posts.details',
              params: { id: comment.post_id },
            }"
            >show post</router-link
          >
        </div>
      </h6>
      <h6 class="card-title" v-if="comment.client">
        <img
          :src="comment.client.image_path"
          class="img-thumbnail"
          style="max-width: 40px"
        />
        <p class="d-inline">{{ comment.client.name }}</p>
        <div class="handle d-inline float-right">
          <button
            class="btn btn-danger mb-1 ml-1"
            @click="deleteComment(comment.id)"
          >
            Delete
          </button>
          <router-link
            class="btn btn-primary mb-1 ml-1"
            :to="{
              name: 'admin.posts.details',
              params: { id: comment.post_id },
            }"
            >show post</router-link
          >
        </div>
      </h6>
      <div class="card-subtitle mb-2 text-muted">
        {{ comment.created_at }}
      </div>
      <p class="card-text">{{ comment.body }}</p>
      <hr />
    </div>
  </div>
</template>
<script>
export default {
  props: ["comments", "pageLoading"],

  emits: ["commentDeleted"],

  methods: {
    deleteComment(id) {
      var deleteConfirmation = new Noty({
        layout: "center",
        killer: true,
        progressBar: false,
        modal: true,
        text: "Confirm Delete ?",
        buttons: [
          Noty.button(
            "YES",
            "btn btn-danger",
            function () {
              deleteComment(id);
            },
            { id: "yes", "data-status": "ok" }
          ),

          Noty.button("NO", "btn btn-error", function () {
            // console.log("button 2 clicked");
            deleteConfirmation.close();
          }),
        ],
      }).show(); //end of delete confirmation

      function deleteComment(id) {
        axios
          .delete(`/api/admin/comments/${id}`)
          .then((response) => {
            if (response.status == 200) {
              location.reload();
            }
          })
          .catch((error) => {
            console.log(error);
          }); //end of api req
      } // end of deletecomment func
    }, //end of deletecomment Method
  },
};
</script>