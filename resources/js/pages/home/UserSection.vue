<template>
  <div>
    <div class="container users">
      <div class="row">
        <div class="text-center col-12 mb-5">
          <h2>Our Bloggers</h2>
          <hr class="w-25 my-5" />
        </div>
        <div class="col-lg-4" v-for="user in users" :key="user.id">
          <img
            class="bd-placeholder-img rounded-circle"
            width="140"
            height="140"
            :src="user.image_path"
          />

          <h2>{{ user.name }}</h2>
          <p>
            {{ user.email }}
          </p>
          <p>
            <a class="btn btn-secondary" :href="'mailto:' + user.email"
              >Send Email</a
            >
          </p>
        </div>
      </div>
      <!-- /.row -->
      <!-- end of users -->
    </div>
  </div>
</template>

<script>
export default {
  props: ["users"],
};
</script>

<style scoped>
.users .col-lg-4 {
  margin-bottom: 1.5rem;
  text-align: center;
}
.users h2 {
  font-weight: 400;
}
.users .col-lg-4 p {
  margin-right: 0.75rem;
  margin-left: 0.75rem;
}
</style>