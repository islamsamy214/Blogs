<template>
  <div>
    <div class="container posts">
      <div class="text-center" style="margin-bottom: 5rem">
        <h2>Recent Blogs</h2>
        <hr class="w-25 my-5" />
      </div>
      <div class="row" v-for="post in posts" :key="post.id">
        <div class="col-md-7">
          <h2 class="posts-heading">
            <span class="text-muted">{{ post.title }}</span>
          </h2>
          <p class="lead">
            {{
              post.body.split("").length - 1 > 110
                ? post.body.slice(0, 100) + "..."
                : post.body
            }}
          </p>
          <router-link
            class="btn btn-secondary mb-3"
            :to="{ name: 'posts.details', params: { id: post.id } }"
            >Read More</router-link
          >
        </div>
        <div class="col-md-5">
          <img
            class="img-thumbnail posts-image img-fluid mx-auto"
            width="500"
            height="500"
            :src="post.image_path"
          />
        </div>
        <div class="col-xm-12 p-5"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts"],
};
</script>

<style scoped>
.posts-heading {
  font-weight: 300;
  line-height: 1;
  letter-spacing: -0.05rem;
}
</style>