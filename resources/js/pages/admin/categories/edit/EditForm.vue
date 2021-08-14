<template>
  <div>
    <div class="row justify-content-left m-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Edit Category</div>
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
  props: ["isLoading", "errors", "oldName"],

  emits: ["submitCategory"],

  data() {
    return {
      name: this.oldName,
      sameValue: true,
    };
  }, //end of data

  watch: {
    name(newValue) {
      if (newValue != this.oldName) {
        this.sameValue = false;
      }else{
        this.sameValue = true;
      }
    },
  }, //end of watch

  methods: {
    fillForm() {
      let formData = new FormData();
      formData.append("name", this.name);
      formData.append("_method", "PUT");

      this.$emit("submitCategory", formData);
    }, //end of filling form
  }, //end of methods
};
</script>