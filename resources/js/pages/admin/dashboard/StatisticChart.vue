<template>
  <div>
    <canvas ref="chart"></canvas>
  </div>
</template>

<script>
import Chart from "chart.js/auto";

export default {
  props: ["clientsData"],

  data() {
    return {
      labels: [],
      data: [],
    };
  },

  methods: {
    fillLabels() {
      for (let label in this.clientsData) {
        this.labels.push(
          this.clientsData[label].year + " - " + this.clientsData[label].month
        );
      }
    }, //end of filling labels

    fillData() {
      for (let dataIndex in this.clientsData) {
        this.data.push(
          this.clientsData[dataIndex].count
        );
      }
    }, //end of fillData

    fillChart() {
      let ctx = this.$refs.chart;
      new Chart(ctx, {
        type: "line",
        data: {
          labels: this.labels,
          datasets: [
            {
              label: "Clients ",
              data: this.data,
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)",
              ],
              borderColor: [
                "rgba(255, 99, 132, 1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)",
              ],
              borderWidth: 1,
            },
          ],
        },
        options: {
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    }, //end of fillChart
  }, //end of methods

  mounted() {
    this.fillLabels();
    this.fillData();
    this.fillChart();
  }, //end of created
};
</script>