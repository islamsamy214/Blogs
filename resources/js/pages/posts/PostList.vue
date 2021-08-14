<template>
  <div>
    <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title">{{ title }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">
          {{ userName }}
        </h6>
        <h6 class="card-subtitle mb-2 text-muted">
          {{ createdAt }}
        </h6>
        <p class="card-text">
          {{
            body.split("").length - 1 > 110 ? body.slice(0, 100) + "..." : body
          }}
        </p>
        <router-link
          :to="{ name: 'posts.details', params: { id: postId } }"
          class="card-link"
          >View Post</router-link
        >
        <div class="d-inline text-muted float-sm-right">
          {{ commentsNumber }} Comments
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "userName", "createdAt", "body", "postId", "commentsNumber"],
};
</script>