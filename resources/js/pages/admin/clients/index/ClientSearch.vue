<template>
  <form class="row" @submit.prevent="submitSearchData">
    <div class="form-group col-md-6 col-sm-12">
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
        >There is no data you can search for empty to back to home or search for
        something could be really here</small
      >
    </div>
    <div class="form-group col-md-6 col-sm-12">
      <button type="submit" class="btn btn-primary">Submit</button>
      <router-link :to="{name:'admin.clients.create'}" class="btn btn-success">Add Client</router-link>
    </div>
  </form>
</template>

<script>
export default {
  props: ["isEmpty"],
  emits: ["submitSearch"],
  data() {
    return {
      searchError: false,
      search: null,
    };
  },
  methods: {
    submitSearchData() {
      this.$emit("submitSearch", this.search);
    },
  },
};
</script>