<template>
  <div>
    <page-header>Comments</page-header>
    <div class="row">
      <comment-search
        @submitSearch="submitSearch"
        :isEmpty="isEmpty"
        class="col-md-6 col-sm-12"
      ></comment-search>
      <comment-paginator
        :pages="pages"
        :currentPage="currentPage"
        :total="total"
        @fill="fill"
        class="col-md-6 col-sm-12"
      ></comment-paginator>
    </div>
    <comment-list
      :comments="comments"
      :pageLoading="pageLoading"
    ></comment-list>
  </div>
</template>

<script>
import CommentList from "./CommentList.vue";
import CommentPaginator from "./CommentPaginator.vue";
import CommentSearch from "./CommentSearch.vue";

export default {
  components: { CommentList, CommentPaginator, CommentSearch },
  data() {
    return {
      comments: [],
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
    // start of filling the comments
    fillComment(response) {
      this.comments = response.data.data;
    },
    //pagination
    fillPaginator(response) {
      this.pages = [];
      for (let resPage = 1; resPage <= response.data.last_page; resPage++) {
        this.pages.push(resPage);
      }
      this.currentPage = response.data.current_page;
    },
    //end of filling the comments

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
      let URL = "/api/admin/comments?page=" + page;

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
          this.fillComment(response);
          this.fillPaginator(response);
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.error = errors.response.data;
        }); //end of axios request
    }, //end of fill function

    commentCreatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Comment Added",
      }).show();
    }, //enf of creating noty

    commentUpdatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Comment Updated",
      }).show();
    }, //enf of Updated noty
  },
  created() {
    this.fill();
    if (this.$route.params.commentCreated == true) {
      this.commentCreatedNotification();
    }
    if (this.$route.params.commentUpdated == true) {
      this.commentUpdatedNotification();
    }
  },
};
</script>