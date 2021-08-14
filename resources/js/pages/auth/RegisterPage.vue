<template>
  <div>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
              <form @submit.prevent="submitRegister">
                <div class="form-group row">
                  <label
                    for="name"
                    class="col-md-4 col-form-label text-md-right"
                    >Name</label
                  >
                  <div class="col-md-6">
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
                  <label
                    for="email"
                    class="col-md-4 col-form-label text-md-right"
                    >E-Mail Address</label
                  >

                  <div class="col-md-6">
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
                    class="col-md-4 col-form-label text-md-right"
                    >Password</label
                  >

                  <div class="col-md-6">
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
                    class="col-md-4 col-form-label text-md-right"
                    >Confirm Password</label
                  >

                  <div class="col-md-6">
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

                <!-- start of error section -->
                <div
                  class="card w-75 mx-auto mb-3 alert alert-danger"
                  v-if="errors"
                >
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-if="errors.name">
                      {{ errors.name[0] }}
                    </li>
                    <li class="list-group-item" v-if="errors.email">
                      {{ errors.email[0] }}
                    </li>
                    <li class="list-group-item" v-if="errors.password">
                      {{ errors.password[0] }}
                    </li>
                  </ul>
                </div>
                <!-- end of error section -->

                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button
                      type="submit"
                      class="btn btn-primary"
                      :disabled="isLoading"
                    >
                      Register
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: false,
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      errors: null,
    };
  }, //end of data

  methods: {
    submitRegister() {
      this.isLoading = true;
      this.submitUser();
    }, //end of submit Register

    submitUser() {
      axios
        .post("/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        })
        .then((response) => {
           if (response.status == 201) {
            this.$router.push({ name: "home" }).then(location.reload());
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.isLoading = false;
        });
      //end of logging in with axios to the controller
    }, //end of submitUser
  }, //end of methods

  beforeCreate() {
    if (this.$store.getters['webAuth/isLoggedIn']) {
      this.$router.back();
    } //end of checking user
  }, //end of created
};
</script>