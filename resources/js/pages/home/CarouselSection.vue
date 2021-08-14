<template>
  <div>
    <div id="home-carousel" class="carousel slide h-100" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#home-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#home-carousel" data-slide-to="1"></li>
        <li data-target="#home-carousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img
            :src="carouselPath + '/carousel-1.jpg'"
            class="img-fluid w-100 h-100"
          />
          <div class="image-overlay"></div>

          <div class="container">
            <div class="carousel-caption text-left">
              <h1>We Learn We Write</h1>
              <p>
                These blogs help you find and keep track of interesting stuff on
                the web. You can subscribe to your favorite websites, and keep
                up with what's popular. New content comes to you when it's
                posted, so you don't need to visit individual sites.
              </p>
              <p>
                <router-link
                  class="btn btn-lg btn-outline-dark text-light"
                  :to="{ name: 'register' }"
                  >Sign up today</router-link
                >
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img
            :src="carouselPath + '/carousel-2.jpg'"
            class="img-fluid w-100 h-100"
          />
          <div class="image-overlay"></div>

          <div class="container">
            <div class="carousel-caption">
              <h1>Day By Day Blogs</h1>
              <p>
                Why do we create? To share a thought: an idea, a story, a
                paradigm. To help another person. Maybe to feel a little more
                understood, a little less crazy. I like what Steven Pressfield
                says about the work of an artist: “The artist doesn’t create to
                express herself; she creates to discover herself.”
              </p>
              <p>
                <router-link
                  class="btn btn-lg btn-outline-dark text-light"
                  :to="{ name: 'about' }"
                  >Learn more</router-link
                >
              </p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img
            :src="carouselPath + '/carousel-3.jpg'"
            class="img-fluid w-100 h-100"
          />
          <div class="image-overlay"></div>

          <div class="container">
            <div class="carousel-caption text-right">
              <h1>Here We write All What We learned In Our Lifes</h1>
              <p>
                Every day, I try to disappear. It is my version of staying sane,
                of getting in touch with what matters most to me. Depending on
                the day, I spend an hour or so walking, typically surrounded by
                trees, hills, and hopefully an animal or two. This is how I
                clear my head, how I work through difficult and uncomfortable
                feelings, how I come up with my best ideas.
              </p>
              <p>
                <router-link
                  class="btn btn-lg btn-outline-dark text-light"
                  :to="{ name: 'posts' }"
                  >Browse blogs</router-link
                >
              </p>
            </div>
          </div>
        </div>
      </div>
      <a
        class="carousel-control-prev"
        href="#home-carousel"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next"
        href="#home-carousel"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</template>

<script>
export default {
    props:['carouselPath']
}
</script>

<style scoped>
.image-overlay {
  width: 100%;
  height: 100%;
  background: #000;
  opacity: 0.5;
}

.carousel {
  margin-bottom: 4rem;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  bottom: 3rem;
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}
</style>