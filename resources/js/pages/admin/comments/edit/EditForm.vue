<template>
  <div>
    <div class="row justify-content-left m-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Edit Comment</div>
          <div class="card-body">
            <form class="w-auto" @submit.prevent="fillComment">
              <div class="form-group mx-sm-3 mb-2 w-auto">
                <label for="comment-area" class="sr-only">Comment</label>
                <textarea
                  class="form-control"
                  id="comment-area"
                  placeholder="Write Something..!!"
                  v-model="body"
                ></textarea>
              </div>
              <div class="form-group mx-sm-3">
                <button
                  type="submit"
                  class="btn btn-primary mb-2"
                  :disabled="isLoading || sameValue"
                >
                  Add Comment
                </button>
              </div>
              <!-- start of error section -->
              <div
                class="card w-75 mx-auto mb-3 alert alert-danger"
                v-if="errors"
              >
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
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  props: ["isLoading", "errors", "oldBody"],

  emits: ["submitComment"],

  data() {
    return {
      body: this.oldBody,
      sameValue: true,
    };
  }, //end of data

  watch: {
    body(newValue) {
      if (newValue != this.oldBody) {
        this.sameValue = false;
      } else {
        this.sameValue = true;
      }
    },
  }, //end of watch

  computed: {
    ...mapGetters({ user: "adminAuth/user" }),
  },

  methods: {
    fillComment() {
      let formData = new FormData();
      formData.append("body", this.body);
      formData.append("post_id", this.$route.params.postId);
      formData.append("user_id", this.user.id);
      formData.append("_method", "PUT");

      this.$emit("submitComment", formData);
    }, //end of filling form
  }, //end of methods
};
</script>