<template>
  <div class="row">
    <div class="col-md-4">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body row">
          <div class="col">
            <h5 class="card-title">Clients</h5>
            <h1 class="card-text">{{ clientsCount }}</h1>
          </div>
          <div class="col">
            <router-link
              :to="{ name: 'admin.clients' }"
              class="btn btn-outline-light w-100 h-100"
            >
              <span class="position-relative" style="top: 25%"> Show </span>
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body row">
          <div class="col">
            <h5 class="card-title">Blogs</h5>
            <h1 class="card-text">{{ postsCount }}</h1>
          </div>
          <div class="col">
            <router-link
              :to="{ name: 'admin.posts' }"
              class="btn btn-outline-light w-100 h-100 d-block"
            >
              <span class="position-relative" style="top: 25%"> Show </span>
            </router-link>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-dark mb-3">
        <div class="card-body row">
          <div class="col">
            <h5 class="card-title">Comments</h5>
            <h1 class="card-text">{{ commentsCount }}</h1>
          </div>
          <div class="col">
            <router-link
              :to="{ name: 'admin.comments' }"
              class="btn btn-outline-light w-100 h-100 d-block"
            >
              <span class="position-relative" style="top: 25%"> Show </span>
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["postsCount", "commentsCount", "clientsCount"],
};
</script>