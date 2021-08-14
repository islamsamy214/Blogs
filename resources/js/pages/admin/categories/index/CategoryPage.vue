<template>
  <div>
    <page-header>Categories</page-header>
    <div class="row">
      <category-search
        @submitSearch="submitSearch"
        :isEmpty="isEmpty"
        class="col-md-6 col-sm-12"
      ></category-search>
      <category-paginator
        :pages="pages"
        :currentPage="currentPage"
        :total="total"
        @fill="fill"
        class="col-md-6 col-sm-12"
      ></category-paginator>
    </div>
    <category-list
      :categories="categories"
      :pageLoading="pageLoading"
    ></category-list>
  </div>
</template>

<script>
import CategoryList from "./CategoryList.vue";
import CategoryPaginator from "./CategoryPaginator.vue";
import CategorySearch from "./CategorySearch.vue";

export default {
  components: { CategoryList, CategoryPaginator, CategorySearch },
  data() {
    return {
      categories: [],
      isEmpty: false,
      pageLoading: true,
      error: null,
      //pagination
      currentPage: null,
      pages: [],
      total: 0,
    };
  },
  methods: {
    // start of filling the categories
    fillCategory(response) {
      this.categories = response.data.data;
    },
    //pagination
    fillPaginator(response) {
      this.pages = [];
      for (let resPage = 1; resPage <= response.data.last_page; resPage++) {
        this.pages.push(resPage);
      }
      this.currentPage = response.data.current_page;
    },
    //end of filling the categories

    //start of search
    submitSearch(search) {
      this.search = search;
      this.fill();
    },
    fillSearch(URL) {
      return URL + "&search=" + this.search;
    },
    //end of search

    getUrl(page) {
      typeof page === "undefined" ? (page = 1) : page;
      let URL = "/api/admin/categories?page=" + page;

      //search section
      if (this.search) {
        URL = this.fillSearch(URL);
      }

      return URL;
    }, //end of stablish the URL

    fill(page) {
      this.pageLoading = true;

      let URL = this.getUrl(page);
      axios
        .get(URL)
        .then((response) => {
          response.data.total == 0
            ? (this.isEmpty = true)
            : (this.isEmpty = false);
          this.total = response.data.total;
          this.fillCategory(response);
          this.fillPaginator(response);
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.error = errors.response.data;
        }); //end of axios request
    }, //end of fill function

    categoryCreatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Category Added",
      }).show();
    }, //enf of creating noty

    categoryUpdatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Category Updated",
      }).show();
    }, //enf of Updated noty
  },
  created() {
    this.fill();
    if (this.$route.params.categoryCreated == true) {
      this.categoryCreatedNotification();
    }
    if (this.$route.params.categoryUpdated == true) {
      this.categoryUpdatedNotification();
    }
  },
};
</script>