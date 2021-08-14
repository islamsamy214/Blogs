<template>
  <div>
    <page-header>Posts</page-header>
    <div class="row">
      <post-search
        @submitSearch="submitSearch"
        :isEmpty="isEmpty"
        :categories="categories"
        :findCategoryId="categoryId"
        class="col-md-6 col-sm-12"
      ></post-search>
      <post-paginator
        :pages="pages"
        :currentPage="currentPage"
        :total="total"
        @fill="fill"
        class="col-md-6 col-sm-12"
      ></post-paginator>
    </div>
    <post-list :posts="posts" :pageLoading="pageLoading"></post-list>
  </div>
</template>

<script>
import PostList from "./PostList.vue";
import PostPaginator from "./PostPaginator.vue";
import PostSearch from "./PostSearch.vue";

export default {
  components: { PostList, PostPaginator, PostSearch },

  data() {
    return {
      posts: [],
      isEmpty: false,
      pageLoading: true,
      error: null,
      //search categories
      categories: [],
      search: null,
      categoryId: null,
      //pagination
      currentPage: null,
      pages: [],
      total: 0,
    };
  }, //end of data

  methods: {
    // start of filling the posts
    fillPosts(response) {
      this.posts = response.data[0].data;
    },

    fillCategories(response) {
      this.categories = response.data[1];
    },
    //pagination
    fillPaginator(response) {
      this.pages = [];
      for (let resPage = 1; resPage <= response.data[0].last_page; resPage++) {
        this.pages.push(resPage);
      }
      this.currentPage = response.data[0].current_page;
    },
    //end of filling the posts

    //start of search
    submitSearch(search, categoryId) {
      this.categoryId = categoryId;
      this.search = search;
      this.fill();
    },
    categorySearch(URL) {
      return URL + "&category=" + this.categoryId;
    },
    searchSearch(URL) {
      return URL + "&search=" + this.search;
    },
    searchAndCategorySearch(URL) {
      return URL + "&search=" + this.search + "&category=" + this.categoryId;
    },
    //end of search

    getUrl(page) {
      typeof page === "undefined" ? (page = 1) : page;
      let URL = "/api/admin/posts?page=" + page;

      //search section
      if (this.search && this.categoryId) {
        URL = this.searchAndCategorySearch(URL);
      } else if (this.search) {
        URL = this.searchSearch(URL);
      } else if (this.categoryId) {
        URL = this.categorySearch(URL);
      }

      return URL;
    }, //end of stablish the URL

    fill(page) {
      this.pageLoading = true;
      let URL = this.getUrl(page);
      axios
        .get(URL)
        .then((response) => {
          response.data[0].total == 0
            ? (this.isEmpty = true)
            : (this.isEmpty = false);
          this.total = response.data[0].total;
          this.fillPosts(response);
          this.fillCategories(response);
          this.fillPaginator(response);
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.error = errors.response.data;
        }); //end of axios request
    }, //end of fill function

    postCreatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Post Added",
      }).show();
    }, //enf of creating noty

    postUpdatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Post Updated",
      }).show();
    }, //enf of Updated noty
  },
  created() {
    if (this.$route.params.categoryId) {
      this.submitSearch(null, this.$route.params.categoryId);
    } else {
      this.fill();
    } //end of filling

    if (this.$route.params.postCreated == true) {
      this.postCreatedNotification();
    }
    if (this.$route.params.postUpdated == true) {
      this.postUpdatedNotification();
    } //end of notifications
  },
};
</script>