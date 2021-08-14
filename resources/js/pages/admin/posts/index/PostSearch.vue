<template>
  <form class="row" @submit.prevent="submitSearchData">
    <div class="form-group col-md-6 col-sm-12">
      <input
        type="text"
        class="form-control mb-1"
        name="search"
        v-model="search"
        aria-describedby="searchHelp"
        placeholder="Search"
      />
      <select
        class="form-control mb-1"
        name="category"
        @change="changeCategory"
      >
        <option :value="null">Choose category</option>
        <option
          v-for="category in categories"
          :key="category.id"
          :value="category.id"
          :selected="findCategoryId == category.id ? true : false"
        >
          {{ category.name }}
        </option>
      </select>
      <small
        id="searchHelp"
        v-if="isEmpty"
        class="form-text text-muted alert alert-danger"
        >There is no data you can search for empty to back to home or search for
        something could be really here</small
      >
    </div>
    <div class="form-group col-md-6 col-sm-12">
      <button type="submit" class="btn btn-primary d-block mb-1">Submit</button>
      <router-link
        :to="{ name: 'admin.posts.create' }"
        class="btn btn-success d-inline-block mb-1"
        >Add Post</router-link
      >
    </div>
  </form>
</template>

<script>
export default {
  props: ["isEmpty", "categories", "findCategoryId"],
  emits: ["submitSearch"],
  data() {
    return {
      categoryId: null,
      search: null,
      searchError: false,
    };
  }, //end of data

  methods: {
    changeCategory(event) {
      this.categoryId = event.target.value;
    }, //end of changeCategory

    submitSearchData() {
      this.$emit("submitSearch", this.search, this.categoryId);
    }, //end of search
  }, //end of methods
};
</script>