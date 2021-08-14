<template>
  <div>
    <page-header>Clients</page-header>
    <div class="row">
      <client-search
        @submitSearch="submitSearch"
        :isEmpty="isEmpty"
        class="col-md-6 col-sm-12"
      ></client-search>
      <client-paginator
        :pages="pages"
        :currentPage="currentPage"
        :total="total"
        @fill="fill"
        class="col-md-6 col-sm-12"
      ></client-paginator>
    </div>
    <client-list :clients="clients" :pageLoading="pageLoading"></client-list>
  </div>
</template>

<script>
import ClientList from "./ClientList.vue";
import ClientPaginator from "./ClientPaginator.vue";
import ClientSearch from "./ClientSearch.vue";

export default {
  components: { ClientList, ClientPaginator, ClientSearch },
  data() {
    return {
      clients: [],
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
    // start of filling the clients
    fillClients(response) {
      this.clients = response.data.data;
    },
    //pagination
    fillPaginator(response) {
      this.pages = [];
      for (let resPage = 1; resPage <= response.data.last_page; resPage++) {
        this.pages.push(resPage);
      }
      this.currentPage = response.data.current_page;
    },
    //end of filling the clients

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
      let URL = "/api/admin/clients?page=" + page;

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
          this.fillClients(response);
          this.fillPaginator(response);
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((errors) => {
          this.error = errors.response.data;
        }); //end of axios request
    }, //end of fill function

    clientCreatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Client Added",
      }).show();
    }, //enf of creating noty

    clientUpdatedNotification() {
      new Noty({
        type: "success",
        layout: "topRight",
        timeout: "2000",
        text: "Client Updated",
      }).show();
    }, //enf of Updated noty
  },
  created() {
    this.fill();
    if (this.$route.params.clientCreated == true) {
      this.clientCreatedNotification();
    }
    if (this.$route.params.clientUpdated == true) {
      this.clientUpdatedNotification();
    }
  },
};
</script>