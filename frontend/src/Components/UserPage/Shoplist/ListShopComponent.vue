<template>
  <div>
    <!-- <img class="w-100 h-95" src="../../../Images/shop1.jpg" alt="Image"> -->
    <section>
      <div class="container px-4 px-lg-5 mt-3">
        <div class="my-3 px-lg-2 flex d-flex align-items-center pb-3 pt-3">
          <router-link to="/" class="nav-link my-3 text-xl font-bold">Home ></router-link>
          <div class="text-lg font-bold text-gray-400">{{ provinceName }}</div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
          <div class="col mb-10" v-for="store in stores" :key="store.id" style="cursor: pointer">
            <router-link
              class="link-underline link-underline-opacity-0"
              :to="{ name: 'listService', params: { id: store.id } }"
            >
              <div @click="handleStoreClick(store)" class="card h-100 hover-shadow">
                <img
                  v-if="store.shop_profile !== null"
                  class="card-img-top"
                  :src="'http://127.0.0.1:8000' + store.shop_profile"
                  alt="Store Image"
                  style="width: auto; height: 10rem"
                />
                <img
                  v-else
                  class="card-img-top"
                  :src="'https://via.placeholder.com/100'"
                  alt="Store Image"
                />
                <div class="card-body">
                  <div class="text-start">
                    <h5 class="text-pink-500">Shop:{{ store.shop_name }}</h5>
                    <p class="mb-0"> {{ store.address.address }}</p>
                  </div>
                  <div class="d-flex justify-content-start">
                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">Open</span>
                    <div class="text-warning pl-2">7:00 AM - 5:00 PM</div>
                  </div>
                  <div class="d-flex justify-content-start">
                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Close</span>
                  </div>
                </div>
              </div>
            </router-link>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
// import axiosInstance from '@/plugins/axios'
import { useSalonStore } from '../../../stores/store'
const useSalon = useSalonStore()
export default defineComponent({
  data() {
    return {
      stores: [],
      provinceName: null,
      selectedProvince: null
    }
  },
  async mounted() {
    await this.fetchStoresByProvinceId(this.$route.params.id)
  },
  methods: {
    async fetchStoresByProvinceId(provinceId: number) {
      await useSalon.getAllStores(provinceId)
      this.stores = useSalon.stores
      this.provinceName = useSalon.province
    },
    handleStoreClick(store: any) {
      // Emit an event to the parent component
      this.$emit('storeClicked', store)
    }
  }
})
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 40px rgba(221, 13, 207, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
  transition: all 0.3s ease-in-out;
}
</style>