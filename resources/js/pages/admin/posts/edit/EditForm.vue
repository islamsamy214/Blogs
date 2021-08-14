<template>
  <div>
    <div class="row justify-content-left m-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Add Post</div>
          <div class="card-body">
            <form @submit.prevent="fillForm" enctype="multipart/form-data">
              <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right"
                  >Title</label
                >
                <div class="col-md-9">
                  <input
                    id="title"
                    type="text"
                    class="form-control"
                    name="title"
                    required
                    autocomplete="title"
                    autofocus
                    v-model="title"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label for="body" class="col-md-2 col-form-label text-md-right"
                  >Body</label
                >

                <div class="col-md-9">
                  <textarea
                    id="body"
                    class="form-control"
                    name="body"
                    required
                    v-model="body"
                    rows="15"
                    placeholder="Write something..!!"
                    aria-required="required"
                  ></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="category"
                  class="col-md-2 col-form-label text-md-right"
                  >Category</label
                >

                <div class="col-md-9">
                  <select
                    name="category"
                    class="form-control"
                    @change="changeCategory"
                  >
                    <option :value="null">Choose category</option>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                      :selected="oldCategoryId == category.id ? true : false"
                    >
                      {{ category.name }}
                    </option>
                  </select>
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
                  <li class="list-group-item" v-if="errors.title">
                    <div v-for="error in errors.title" :key="error">
                      {{ error }}
                    </div>
                  </li>
                  <li class="list-group-item" v-if="errors.body">
                    <div v-for="error in errors.body" :key="error">
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
  props: [
    "isLoading",
    "errors",
    "oldTitle",
    "oldBody",
    "oldCategoryId",
    "categories",
  ],

  emits: ["submitPost"],

  data() {
    return {
      title: this.oldTitle,
      body: this.oldBody,
      categoryId: this.oldCategoryId,
      image: null,
      sameValue: true,
    };
  }, //end of data

  watch: {
    title(newTitle) {
      if (newTitle == this.oldTitle) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of name

    body(newBody) {
      if (newBody == this.oldBody) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of email

    categoryId(newCat) {
      if (newCat == this.oldCategoryId) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of category change

    image(newImage) {
      if (newImage == null) {
        this.sameValue = true;
      } else {
        this.sameValue = false;
      }
    }, //end of password
  }, //end of watch

  methods: {
    changeCategory(event) {
      this.categoryId = event.target.value;
    }, //end of changeCategory

    uploadImage(event) {
      this.image = event.currentTarget.files[0];
    }, //end of image upload

    fillForm() {
      let formData = new FormData();
      formData.append("title", this.title);
      formData.append("body", this.body);
      formData.append("category_id", this.categoryId);
      formData.append("user_id", this.$store.getters["adminAuth/user"].id);
      formData.append("_method", "PUT");
      if (this.image) {
        formData.append("image", this.image);
      }

      this.$emit("submitPost", formData);
    }, //end of filling form
  }, //end of methods
};
</script>