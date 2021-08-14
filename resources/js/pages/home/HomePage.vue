<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div v-else>
      <carousel-section :carouselPath="carouselPath"></carousel-section>
      <div class="divider"></div>
      <user-section :users="users"></user-section>
      <div class="divider"></div>
      <post-section :posts="posts"></post-section>
    </div>
    <!-- /.container -->
  </div>
</template>

<script>
import CarouselSection from "./CarouselSection.vue";
import PostSection from "./PostSection.vue";
import UserSection from "./UserSection.vue";

export default {
  components: { CarouselSection, UserSection, PostSection },
  data() {
    return {
      pageLoading: true,
      carouselPath: null,
      users: null,
      posts: null,
    };
  }, //end of data

  methods: {
    fillData() {
      axios
        .get("/api/home")
        .then((response) => {
          this.carouselPath = response.data.carouselPath;
          this.users = response.data.users;
          this.posts = response.data.posts;
        })
        .then(() => {
          this.pageLoading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  }, //end of methods

  created() {
    this.fillData();
  }, //end of created
};
</script>

<style>
.divider {
  margin: 10rem 0;
}
/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 350px) {
  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 1.25rem;
    font-size: 0.75rem;
    line-height: 1.4;
  }

  .carousel-item {
    height: 30rem;
  }

  .posts-heading {
    font-size: 50px;
  }
}

@media (min-width: 768px) {
  .carousel-caption p {
    margin-bottom: 1.25rem;
    font-size: 1.25rem;
    line-height: 1.4;
  }
  .carousel-item {
    height: 46rem;
  }

  .posts-heading {
    font-size: 50px;
  }
}
</style>