<template>
  <div>
    <div class="card-footer" v-if="post.comments">
      <div
        class="comment px-3 py-2"
        v-for="comment in post.comments"
        :key="comment.id"
      >
        <h6 class="card-title" v-if="comment.user">
          <img
            :src="comment.user.image_path"
            class="img-thumbnail"
            style="max-width: 40px"
          />
          <p class="d-inline">
            {{ comment.user.name }}
            <span class="badge badge-primary">Admin</span>
          </p>
          <div class="handle-drop-down d-inline float-right">
            <a
              id="handeDropDown"
              class="nav-link dropdown-toggle d-inline-block"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            ></a>

            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="handeDropDown"
            >
              <router-link
                class="dropdown-item"
                :to="{
                  name: 'admin.comments.edit',
                  params: { id: comment.id, postId: post.id },
                }"
                >Edit</router-link
              >
              <button
                class="dropdown-item text-danger"
                @click="deleteComment(comment.id)"
              >
                Delete
              </button>
            </div>
          </div>
        </h6>
        <h6 class="card-title" v-if="comment.client">
          <img
            :src="comment.client.image_path"
            class="img-thumbnail"
            style="max-width: 40px"
          />
          <p class="d-inline">{{ comment.client.name }}</p>
          <div class="handle-drop-down d-inline float-right">
            <a
              id="handeDropDown"
              class="nav-link dropdown-toggle d-inline-block"
              href="#"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            ></a>

            <div
              class="dropdown-menu dropdown-menu-right"
              aria-labelledby="handeDropDown"
            >
              <button
                class="dropdown-item text-danger"
                @click="deleteComment(comment.id)"
              >
                Delete
              </button>
            </div>
          </div>
        </h6>
        <div class="card-subtitle mb-2 text-muted">
          {{ comment.created_at }}
        </div>
        <p class="card-text">{{ comment.body }}</p>
        <hr />
      </div>
      <form class="w-auto" @submit.prevent="fillComment">
        <div class="form-group mx-sm-3 mb-2 w-auto">
          <label for="comment-area" class="sr-only">Comment</label>
          <textarea
            class="form-control"
            id="comment-area"
            placeholder="Comment"
            v-model="body"
          ></textarea>
        </div>
        <div class="form-group mx-sm-3">
          <button
            type="submit"
            class="btn btn-primary mb-2"
            :disabled="isLoading"
          >
            Add Comment
          </button>
        </div>
        <!-- start of error section -->
        <div class="card w-75 mx-auto mb-3 alert alert-danger" v-if="errors">
          <ul class="list-group list-group-flush">
            <li class="list-group-item" v-if="errors.body">
              <div v-for="error in errors.body" :key="error">
                {{ error }}
              </div>
            </li>
            <li class="list-group-item" v-if="errors.user_id">
              <div v-for="error in errors.user_id" :key="error">
                {{ error }}
              </div>
            </li>
            <li class="list-group-item" v-if="errors.post_id">
              <div v-for="error in errors.post_id" :key="error">
                {{ error }}
              </div>
            </li>
            <li class="list-group-item" v-if="errors.client_id">
              <div v-for="error in errors.client_id" :key="error">
                {{ error }}
              </div>
            </li>
          </ul>
        </div>
        <!-- end of error section -->
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: ["post"],

  data() {
    return {
      body: null,
      errors: null,
      isLoading: false,
    };
  }, //end of data

  computed: {
    ...mapGetters({ user: "adminAuth/user" }),
  }, //end of computed

  methods: {
    fillComment() {
      let formData = new FormData();
      formData.append("body", this.body);
      formData.append("post_id", this.post.id);
      formData.append("user_id", this.user.id);

      this.$emit("submitComment", formData);
    }, //end of fillcomment

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
  }, //end of mehtods
};
</script>