<template>
  <div>
    <div class="row justify-content-left m-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Edit Client</div>
          <div class="card-body">
            <form @submit.prevent="fillForm" enctype="multipart/form-data">
              <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right"
                  >Name</label
                >
                <div class="col-md-9">
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    name="name"
                    required
                    autocomplete="name"
                    autofocus
                    v-model="name"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label text-md-right"
                  >E-Mail Address</label
                >

                <div class="col-md-9">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    required
                    autocomplete="email"
                    v-model="email"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-2 col-form-label text-md-right"
                  >Password</label
                >

                <div class="col-md-9">
                  <input
                    id="password"
                    type="password"
                    class="form-control"
                    name="password"
                    required
                    autocomplete="new-password"
                    v-model="password"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password-confirm"
                  class="col-md-2 col-form-label text-md-right"
                  >Confirm Password</label
                >

                <div class="col-md-9">
                  <input
                    id="password-confirm"
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    v-model="password_confirmation"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="image" class="col-md-2 col-form-label text-md-right"
                  >Image</label
                >

                <div class="col-md-9">
                  <input
                    id="image"
                    type="file"
                    class="form-control"
                    name="Image"
                    @change="uploadImage"
                  />
                </div>
              </div>

              <!-- start of error section -->
              <div
                class="card w-75 mx-auto mb-3 alert alert-danger"
                v-if="errors"
              >
                <ul class="list-group list-group-flush">
                  <li class="list-group-item" v-if="errors.name">
                    <div v-for="error in errors.name" :key="error">
                      {{ error }}
                    </div>
                  </li>
                  <li class="list-group-item" v-if="errors.email">
                    <div v-for="error in errors.email" :key="error">
                      {{ error }}
                    </div>
                  </li>
                  <li class="list-group-item" v-if="errors.password">
                    <div v-for="error in errors.password" :key="error">
                      {{ error }}
                    </div>
                  </li>
                  <li class="list-group-item" v-if="errors.image">
                    <div v-for="error in errors.image" :key="error">
                      {{ error }}
                    </div>
                  </li>
                </ul>
              </div>
              <!-- end of error section -->

              <div class="form-group row mb-0 text-right">
                <div class="col-md-6 offset-md-4">
                  <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="isLoading || sameValue"
                  >
                    Submit
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["errors", "isLoading", "oldName", "oldEmail"],

  emits: ["submitClient"],

  data() {
    return {
      name: this.oldName,
      email: this.oldEmail,
      password: null,
      password_confirmation: null,
      image: null,
      sameValue: true,
    };
  }, //end of data

  watch: {
    name(newName) {
      if (newName == this.oldName) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of name

    email(newEmail) {
      if (newEmail == this.oldEmail) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of email

    password(newPassword) {
      if (newPassword == null) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    },//end of password

    image(newImage) {
      if (newImage == null) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    },//end of password
  }, //end of watch

  methods: {
    uploadImage(event) {
      this.image = event.currentTarget.files[0];
    }, //end of image upload

    fillForm() {
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.password_confirmation);
      formData.append("_method", "PUT");
      if (this.image) {
        formData.append("image", this.image);
      }

      this.$emit("submitClient", formData);
    }, //end of filling form
  }, //end of methods
};
</script>