<template>
  <div>
    <loading-ui v-if="pageLoading"></loading-ui>
    <div class="card mt-2" v-for="post in posts" :key="post.id" v-else>
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">
          {{ post.user.name }}
        </h6>
        <h6 class="card-subtitle mb-2 text-muted">
          {{ post.created_at }}
        </h6>
        <p class="card-text">
          {{
            post.body.split("").length - 1 > 110 ? post.body.slice(0, 100) + "..." : post.body
          }}
        </p>
        <router-link
          :to="{ name: 'admin.posts.details', params: { id: post.id } }"
          class="card-link"
          >View Post</router-link
        >
        <div class="d-inline text-muted float-sm-right">
          {{ post.comments_count }} Comments
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["posts", "pageLoading"],
};
</script>