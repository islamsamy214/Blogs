<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div class="container-fluied" v-else>
      <div class="row">
        <div class="col-lg-6 col-xs-12">
          <img :src="aboutImagePath" class="img-fluid w-100" />
        </div>
        <div class="col-lg-6 col-xs-12 text-center mt-5 pt-5">
          <h1 style="font-size: 3rem">About.</h1>
          <hr class="w-25 my-5" />
          <p style="font-size: 1rem" class="w-75 mx-auto">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda
            explicabo esse quae facilis optio, deleniti quo dignissimos delectus
            asperiores quaerat nesciunt blanditiis veniam dolore corporis cum
            quasi fugiat, velit ad. Lorem ipsum dolor sit amet consectetur
            adipisicing elit. Voluptatem alias molestiae quam unde tempora illum
            doloribus necessitatibus voluptatum quidem earum, eligendi eveniet
            quas, architecto dolores maiores sunt minus nam consequuntur.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pageLoading: true,
      aboutImagePath: null,
    };
  }, //end of data

  methods: {
    getImagePath() {
      axios
        .get("/api/about")
        .then((response) => {
          this.aboutImagePath = response.data;
        })
        .then(() => {
          this.pageLoading = false;
        });
    },
  }, //end of methods

  created() {
    this.getImagePath();
  }, //end of created
};
</script>