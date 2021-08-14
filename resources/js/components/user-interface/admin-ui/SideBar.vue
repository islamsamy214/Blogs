<template>
  <div>
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <router-link
            class="nav-link"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'dashboard',
            }"
            :to="{ name: 'admin.dashboard' }"
          >
            Dashboard <span class="sr-only">(current)</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.settings' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'settings',
            }"
          >
            Settings
          </router-link>
        </li>
        <h6
          class="
            sidebar-heading
            d-flex
            justify-content-between
            align-items-center
            px-3
            mt-4
            mb-1
            text-muted
          "
        >
          <span>Users</span>
        </h6>

        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.users' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'users',
            }"
          >
            Users
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.clients' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'clients',
            }"
          >
            Clients
          </router-link>
        </li>
      </ul>

      <h6
        class="
          sidebar-heading
          d-flex
          justify-content-between
          align-items-center
          px-3
          mt-4
          mb-1
          text-muted
        "
      >
        <span>Blogs</span>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.categories' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'categories',
            }"
          >
            Categories
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.posts' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'posts',
            }"
          >
            Blogs
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            :to="{ name: 'admin.comments' }"
            :class="{
              active: this.$route.fullPath.split('/')[2] == 'comments',
            }"
          >
            Comments
          </router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
/*
 * Sidebar
 */
li.nav-item a.nav-link {
  font-size: 14px;
}

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 48px 0 0; /* Height of navbar */
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 5rem;
  }
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

@supports ((position: -webkit-sticky) or (position: sticky)) {
  .sidebar-sticky {
    position: -webkit-sticky;
    position: sticky;
  }
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link.active {
  color: #007bff;
}

.sidebar-heading {
  font-size: 0.75rem;
  text-transform: uppercase;
}
</style>