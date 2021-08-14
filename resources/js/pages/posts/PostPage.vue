<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div class="container">
      <div class="row">
        <!-- start of the left side -->
        <div class="col-md-8 col-xs-12">
          <div class="mt-2 text-center m-5" v-if="isEmpty">
            <h2>There is no data to show</h2>
          </div>
          <div class="mt-2 text-center m-5" v-if="error">
            <h2>{{ error.message }}</h2>
          </div>
          <!-- start of posts section -->
          <post-list-component
            v-for="post in posts"
            :key="post.id"
            :title="post.title"
            :userName="post.user.name"
            :createdAt="post.created_at"
            :body="post.body"
            :postId="post.id"
            :commentsNumber="post.comments_count"
          ></post-list-component>
          <!-- end of psots section -->
        </div>
        <!-- end of the left side -->
        <!-- start of the right side -->
        <div class="col-md-3 col-xs-12 m-2">
          <div class="row">
            <div class="card col-12">
              <post-search-component
                @submitSearch="submitSearch"
                :categories="categories"
                :isEmpty="isEmpty"
              ></post-search-component>
            </div>
            <!-- start of paginator -->
            <div class="pagination col-12 pt-3">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <li class="page-item">
                    <a
                      class="page-link"
                      href=""
                      @click.prevent="fill(currentPage - 1)"
                      v-if="currentPage != 1"
                      >Previous</a
                    >
                  </li>
                  <li class="page-item" v-for="page in pages" :key="page">
                    <a
                      class="page-link"
                      :class="{ active: page == currentPage }"
                      href=""
                      @click.prevent="fill(page)"
                      >{{ page }}</a
                    >
                  </li>
                  <li class="page-item">
                    <a
                      class="page-link"
                      href=""
                      @click.prevent="fill(currentPage + 1)"
                      v-if="currentPage != pages.length"
                      >Next</a
                    >
                  </li>
                </ul>
              </nav>
            </div>
            <!-- end of paginator -->
          </div>
        </div>
        <!-- end of the right side -->
      </div>
    </div>
  </div>
</template>

<script>
import PostListComponent from "./PostList.vue";
import PostSearchComponent from "./PostSearchComponent.vue";
// end of imports

export default {
  components: {
    PostListComponent,
    PostSearchComponent,
  },
  //end of components

  data() {
    return {
      posts: [],
      categories: [],
      pages: [],
      currentPage: null,
      categoryId: null,
      search: null,
      pageLoading: true,
      isEmpty: false,
      error: null,
    };
  },
  //end of data

  methods: {
    // start of filling the posts
    fillPosts(response) {
      this.posts = response.data[0].data;
    },
    fillCategories(response) {
      this.categories = response.data[1];
    },
    fillPaginator(response) {
      this.pages = [];
      for (let resPage = 1; resPage <= response.data[0].last_page; resPage++) {
        this.pages.push(resPage);
      }
      this.currentPage = response.data[0].current_page;
    },
    //end of filling the posts

    //start of search
    submitSearch(categoryId, search) {
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
      let URL = "/api/posts?page=" + page;

      //search section
      if (this.search && this.categoryId) {
        URL = this.searchAndCategorySearch(URL);
      } else if (this.search) {
        URL = this.searchSearch(URL);
      } else if (this.categoryId) {
        URL = this.categorySearch(URL);
      }

      return URL;
    },
    //end of returning the URL to process the fill function

    fill(page) {
      let URL = this.getUrl(page);
      axios
        .get(URL)
        .then((response) => {
          response.data[0].total == 0
            ? (this.isEmpty = true)
            : (this.isEmpty = false);
          this.fillPosts(response);
          this.fillCategories(response);
          this.fillPaginator(response);
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.error = errors.response.data;
        });
    }, //end of fill function
  },
  //end of methods

  created() {
    this.fill();
  }, //end of created
}; //end of script
</script>

<style scoped>
a.active {
  background-color: #007bff;
  color: #ffffff;
}
</style>