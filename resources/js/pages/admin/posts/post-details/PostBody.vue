<template>
  <div>
    <div class="card-body">
      <div class="mb-2">
        <h5 class="card-title d-inline">
          <img
            :src="post.user.image_path"
            class="img-thumbnail"
            style="max-width: 40px"
          />
          {{ post.user.name }}
        </h5>
        <div class="d-inline float-right">
          <router-link
            class="btn btn-warning ml-1 mt-1"
            :to="{ name: 'admin.posts.edit', params: { id: post.id } }"
            >Edit</router-link
          >
          <button class="btn btn-danger ml-1 mt-1" @click="deletePost(post.id)">
            Delete
          </button>
        </div>
      </div>
      <h6 class="card-subtitle mb-2 text-muted d-inline">
        {{ post.created_at }}
      </h6>
      <p class="card-text text-muted">
        {{ post.title }}
      </p>
      <img
        :src="post.image_path"
        class="rounded mx-auto d-block mb-3 img-fluid"
        style="max-height: 600px"
        v-if="post.image"
      />
      <p class="card-subtitle mb-2">
        {{ post.body }}
      </p>
      <h6
        class="card-subtitle mb-2 text-muted d-inline float-right"
        v-if="post.comments"
      >
        {{ post.comments.length }} comments
      </h6>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post"],

  methods: {
    deletePost(id) {
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
              deletePost(id);
            },
            { id: "yes", "data-status": "ok" }
          ),

          Noty.button("NO", "btn btn-error", function () {
            deleteConfirmation.close();
          }),
        ],
      }).show(); //end of delete confirmation

      function deletePost(id) {
        axios
          .delete(`/api/admin/posts/${id}`)
          .then((response) => {
            if (response.status == 200) {
              location.href = "/admin/posts";
            }
          })
          .catch((error) => {
            console.log(error);
          }); //end of api req
      } // end of deletepost func
    }, //end of deletepost Method
  }, //end of methods
};
</script>