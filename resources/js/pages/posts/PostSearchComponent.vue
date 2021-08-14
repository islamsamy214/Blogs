<template>
  <form class="py-4" @submit.prevent="submitSearchData">
    <div class="form-group">
      <select
        class="form-control mb-3"
        name="category"
        @change="changeCategory"
      >
        <option :value="null">Choose category</option>
        <option
          v-for="category in categories"
          :key="category.id"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
      <input
        type="text"
        class="form-control"
        name="search"
        v-model="search"
        aria-describedby="searchHelp"
        placeholder="Search"
      />
      <small
        id="searchHelp"
        v-if="isEmpty"
        class="form-text text-muted alert alert-danger"
        >There is no data you can search for empty to back to home or search for something could be really here</small
      >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
export default {
  props: ["categories","isEmpty"],
  emits:['submitSearch'],
  data() {
    return {
      searchError: false,
      categoryId: null,
      search: null,
    };
  },
  methods: {
    changeCategory(event) {
      this.categoryId = event.target.value;
    },
    submitSearchData() {
      this.$emit('submitSearch',this.categoryId,this.search);
    },
  },
};
</script>