<template>
  <div>
    <page-header>Settings</page-header>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div class="row justify-content-left m-2" v-else>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Edit Settings</div>
          <div class="card-body">
            <form @submit.prevent="fillForm" enctype="multipart/form-data">
              <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-right"
                  >Site Name</label
                >
                <div class="col-md-9">
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    name="site_name"
                    required
                    autocomplete="name"
                    autofocus
                    v-model="siteName"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label text-md-right"
                  >Contact E-Mail</label
                >

                <div class="col-md-9">
                  <input
                    id="email"
                    type="email"
                    class="form-control"
                    name="contact_email"
                    required
                    autocomplete="email"
                    v-model="contactEmail"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-2 col-form-label text-md-right"
                  >Address</label
                >

                <div class="col-md-9">
                  <input
                    id="email"
                    type="text"
                    class="form-control"
                    name="address"
                    required
                    autocomplete="email"
                    v-model="address"
                  />
                </div>
              </div>

              <!-- start of error section -->
              <div
                class="card w-75 mx-auto mb-3 alert alert-danger"
                v-if="errors"
              >
                <ul class="list-group list-group-flush">
                  <li class="list-group-item" v-if="errors.site_name">
                    <div v-for="error in errors.site_name" :key="error">
                      {{ error }}
                    </div>
                  </li>
                  <li class="list-group-item" v-if="errors.contact_email">
                    <div v-for="error in errors.contact_email" :key="error">
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
                    :disabled="isLoading"
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
  data() {
    return {
      pageLoading: true,
      siteName: null,
      contactEmail: null,
      address: null,
      errors: null,
      isLoading: true,
    };
  }, //end of data

  watch: {
    siteName(newValue, oldValue, olderValue) {
      if (oldValue != olderValue) {
        this.isLoading = false;
      }
    },
    contactEmail(newValue, oldValue, olderValue) {
      if (oldValue != olderValue) {
        this.isLoading = false;
      }
    },
    address(newValue, oldValue, olderValue) {
      if (oldValue != olderValue) {
        this.isLoading = false;
      }
    },
  },

  methods: {
    fill() {
      axios
        .get(`/api/admin/settings`)
        .then((response) => {
          this.siteName = response.data.site_name;
          this.contactEmail = response.data.contact_email;
          this.address = response.data.address;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    fillForm() {
      let formData = new FormData();
      formData.append("site_name", this.siteName);
      formData.append("contact_email", this.contactEmail);
      formData.append("address", this.address);
      formData.append("_method", "PUT");

      this.submitClient(formData);
    }, //end of filling form

    submitClient(formData) {
      axios
        .post(`/api/admin/settings`, formData)
        .then((response) => {
          if (response.status == 200) {
            new Noty({
              type: "success",
              layout: "topRight",
              timeout: "2000",
              text: "Settings Updated",
            }).show();
            this.errors = null;
          }
        })
        .catch((errors) => {
          this.errors = errors.response.data.errors;
        })
        .then(() => {
          this.isLoading = true;
        });
    }, //end of submtting the form
  }, //end of mehtods

  created() {
    this.fill();
  }, //end of created
};
</script>