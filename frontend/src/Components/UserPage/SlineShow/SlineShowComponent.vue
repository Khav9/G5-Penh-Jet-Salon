<template>
  <div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button v-for="(image, index) in slide.slides" :key="image.id" type="button"
          :data-bs-target="'#carouselExampleIndicators'" :data-bs-slide-to="index" :class="{ active: index === 0 }"
          :aria-label="'Slide ' + (index + 1)"></button>
      </div>
      <div class="carousel-inner">
        <div v-for="(image, index) in slide.slides" :key="image.id" :class="['carousel-item', { active: index === 0 }]">
          <img :src="baseURL + image.image" class="d-block w-100 h-90 " alt="" />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Register employee -->
    <div class="card">
      <h1 class="p-13 text-center font-weight-bold text-muted">
        We are here to help you live life the salon way.<br />Spend more time doing what you love.
        <br />We'll take care of relaxing treatments, stylish cuts, and new looks.
      </h1>
      <img class="w-100" style="height: 30rem" src="../../../Images/shop1.jpg" alt="Image" />
      <div class="card-img-overlay">
        <div class="pl-10 cardRegister mt-130">
          <div class="card w-50 bg-light">
            <div class="card-body">
              <h3 class="text-pink-500">Join your shop here!</h3>
              <p class="card-text">
                Expand your client base and streamline your booking process by becoming a Sala Salon
                Partner.
              </p>
              <p class="card-text">
                Our centralized online booking system and marketing support make it easy for
                customers to discover and book appointments at your salon.
              </p>
              <button class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-300">
                <router-link to="/registerOwner" class="nav-link">Register now</router-link>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import 'bootstrap/dist/js/bootstrap.bundle.js'
import { useSlideStore } from '@/stores/slide'
const slide = useSlideStore()
import axiosInstance from '@/api/api'
const base = axiosInstance

export default {
  data() {
    return {
      slide: useSlideStore(),
      baseURL: ''
    }
  },
  methods: {
    async getSlide() {
      slide.getAllSlide()
    },
    getBaseURL() {
      const url = base.defaults.baseURL
      return url.endsWith('/api') ? url.slice(0, -4) : url
    }
  },
  mounted() {
    this.baseURL = this.getBaseURL();
    this.getSlide()
  }
}
</script>