<template>
  <div>
    <div class="card-body">
      <div class="mb-2">
        <h5 class="card-title d-inline">
          <img
            :src="post.user.image_path"
            class="img-thumbnail"
            style="max-width: 40px"
          />
          {{ post.user.name }}
        </h5>
        
      </div>
      <h6 class="card-subtitle mb-2 text-muted d-inline">
        {{ post.created_at }}
      </h6>
      <p class="card-text text-muted">
        {{ post.title }}
      </p>
      <img
        :src="post.image_path"
        class="rounded mx-auto d-block mb-3 img-fluid"
        style="max-height: 600px"
        v-if="post.image"
      />
      <p class="card-subtitle mb-2">
        {{ post.body }}
      </p>
      <h6
        class="card-subtitle mb-2 text-muted d-inline float-right"
        v-if="post.comments"
      >
        {{ post.comments.length }} comments
      </h6>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post"],
};
</script>