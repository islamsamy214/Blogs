<template>
  <div>
    <page-header>Dashboard</page-header>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div v-else>
      <statistic-card
        :clientsCount="clientsCount"
        :commentsCount="commentsCount"
        :postsCount="postsCount"
      ></statistic-card>
      <statistic-chart :clientsData="clientsData"></statistic-chart>
    </div>
  </div>
</template>

<script>
import StatisticCard from "./StatisticCard.vue";
import StatisticChart from "./StatisticChart.vue";

export default {
  components: {
    StatisticCard,
    StatisticChart,
  }, //end of components

  data() {
    return {
      pageLoading: true,
      clientsCount: null,
      commentsCount: null,
      postsCount: null,
      clientsData: null,
    };
  }, //end of data

  methods: {
    getCounts() {
      axios
        .get("/api/admin/dashboard")
        .then((response) => {
          this.clientsCount = response.data[0];
          this.commentsCount = response.data[1];
          this.postsCount = response.data[2];
          this.clientsData = response.data[3];
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          console.log(error.response);
        });
    }, //end of get the counts
  }, //end of methods

  created() {
    this.getCounts();
  }, //end of created
};
</script>