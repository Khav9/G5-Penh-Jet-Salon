<template>
  <div class="">
    <div class="flex justify-center">
      <div class="w-1/2">
        <form class="pt-8">
          <!-- Error/Success Messages -->
          <div class="mb-1">
            <div
              v-if="error !== ''"
              class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
              role="alert"
            >
              <svg
                class="flex-shrink-0 inline w-4 h-4 me-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                />
              </svg>
              <span class="sr-only">Info</span>
              <div>
                <span class="font-medium">{{ error }}</span>
              </div>
            </div>
            <!-- Search Input and Locator Button -->
            <div class="flex items-center border border-gray-300 dark:border-gray-700 rounded-lg">
              <input
                type="text"
                class="w-full py-2 px-4 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                id="search_input"
                placeholder="Enter your address"
                v-model="searchInput"
              />
              <svg
                class="py-1 transition duration-300 ease-in-out transform hover:scale-154"
                xmlns="http://www.w3.org/2000/svg"
                height="24px"
                viewBox="0 -960 960 960"
                width="24px"
                fill="blue"
                @click.prevent="locatorButtonPressed"
              >
                <path
                  d="M440-42v-80q-125-14-214.5-103.5T122-440H42v-80h80q14-125 103.5-214.5T440-838v-80h80v80q125 14 214.5 103.5T838-520h80v80h-80q-14 125-103.5 214.5T520-122v80h-80Zm40-158q116 0 198-82t82-198q0-116-82-198t-198-82q-116 0-198 82t-82 198q0 116 82 198t198 82Zm0-120q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T560-480q0-33-23.5-56.5T480-560q-33 0-56.5 23.5T400-480q0 33 23.5 56.5T480-400Zm0-80Z"
                />
              </svg>
            </div>
          </div>
          <!-- Submit Button -->
          <button
            type="submit"
            class="py-2 px-4 bg-blue-500 text-white rounded-lg transition duration-300 ease-in-out transform hover:scale-105"
          >
            Find Shop
          </button>
        </form>
      </div>
    </div>
    <!-- Map Container -->
    <div class="mt-8">
      <div class="text-center">
        <div ref="map" style="width: 100%; height: 400px"></div>
      </div>
    </div>
    
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useSalonStore } from '@/stores/store'
import { useRoute } from 'vue-router'
import url from '../../api/url'

const route = useRoute()
const map = ref(null)
const address = ref('')
const error = ref('')
const searchInput = ref('')
const useSalon = useSalonStore()
const id = ref(route.params.id)
const shops = ref([])
let googleMap = null
let currentLocationMarker = null
const markers = [] // Store markers to remove later

const locatorButtonPressed = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        getAddressFrom(position.coords.latitude, position.coords.longitude)
        updateLocationOnMap(position.coords.latitude, position.coords.longitude)
      },
      (error) => {
        handleError(error.message)
      }
    )
  } else {
    handleError('Geolocation is not supported by this browser.')
  }
  searchInput.value = ''
}

const getAddressFrom = (lat, long) => {
  axios
    .get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${long}&key=AIzaSyDtSAkdlKPhpaKbVV4B_m7QO2b8CrBEGJ8`)
    .then((response) => {
      if (response.data.error_message) {
        handleError(response.data.error_message)
      } else {
        address.value = response.data.results[0].formatted_address
      }
    })
    .catch((error) => {
      handleError(error.message)
    })
}

const updateLocationOnMap = (lat, long) => {
  if (window.google && window.google.maps && googleMap) {
    googleMap.panTo({ lat, lng: long })

    const beachFlagImg = {
      url: 'https://cdn-icons-png.flaticon.com/512/12207/12207498.png',
      scaledSize: new google.maps.Size(50, 50)
    }

    if (currentLocationMarker) {
      currentLocationMarker.setPosition({ lat, lng: long })
    } else {
      currentLocationMarker = new window.google.maps.Marker({
        position: { lat, lng: long },
        map: googleMap,
        icon: beachFlagImg,
        title: `${lat},${long}`
      })
    }
  } else {
    console.error('Google Maps API is not loaded')
  }
}

const handleError = (errorMessage) => {
  error.value = errorMessage
}

const mapOfSalons = () => {
  // Clear existing markers
  markers.forEach((marker) => {
    marker.setMap(null)
  })
  markers.length = 0

  if (window.google && window.google.maps && googleMap) {
    const salonImage = {
      url: 'https://cdn.iconscout.com/icon/premium/png-256-thumb/salon-location-3818204-3179250.png',
      scaledSize: new google.maps.Size(36, 36)
    }

    shops.value.forEach((shop) => {
      let latitude = parseFloat(shop.address.lat)
      let longitude = parseFloat(shop.address.lng)
      const marker = new window.google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map: googleMap,
        icon: salonImage,
        title: shop.address.address
        // animation: google.maps.Animation.DROP
      })

      const infoWindow = new window.google.maps.InfoWindow({
        content: `
      <div class="bg-white rounded-lg">
                  <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="${
                          url + shop.shop_profile
                        }" alt="Neil image">
                    </div>
          <p class="text-pink-600">${shop.shop_name}</p>
          <p class="text-gray-600">${shop.address.address}</p>
      </div>
              `
      })

      marker.addListener('click', () => {
        infoWindow.open(googleMap, marker)
      })

      markers.push(marker) // Store marker for future removal
    })
  }
}

const fetchStores = () => {
  useSalon.getAllStores(id.value).then(() => {
    shops.value = useSalon.stores
    if (window.google && window.google.maps && map.value && !googleMap) {
      googleMap = new window.google.maps.Map(map.value, {
        center: { lat: 11.5344226, lng: 104.8804893 },
        zoom: 12,
        gestureHandling: 'smooth'
      })
    }
    mapOfSalons()
  })
}

onMounted(() => {
  fetchStores()
  shops.value = useSalon.stores
  if (window.google && window.google.maps && map.value) {
    googleMap = new window.google.maps.Map(map.value, {
      center: { lat: 11.5344226, lng: 104.8804893 },
      zoom: 12,
      gestureHandling: 'smooth'
    })
    mapOfSalons()
  }

  const autocomplete = new google.maps.places.Autocomplete(
    document.getElementById('search_input'),
    {
      types: ['geocode'],
      componentRestrictions: {
        country: 'KH'
      }
    }
  )

  google.maps.event.addListener(autocomplete, 'place_changed', () => {
    const place = autocomplete.getPlace()
    if (place.geometry && place.geometry.location) {
      const latitude = place.geometry.location.lat()
      const longitude = place.geometry.location.lng()
      getAddressFrom(latitude, longitude)
      updateLocationOnMap(latitude, longitude)
    }
  })
})
</script>

