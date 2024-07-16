<template>
  <WebLayout>
    <div class="container mt-4 p-4 bg-white shadow rounded">
      <div class="text-center mb-4">
        <h3 class="text-gray-500">History Booking</h3>
      </div>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Shop Name</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Price</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="booking in store.bookings" :key="booking.id">
              <th scope="row">{{ booking.id }}</th>
              <td>{{ booking.shop_name }}</td>
              <td>{{ booking.date }}</td>
              <td>{{ booking.time }}</td>
              <td>${{ booking.total_price }}</td>
              <td class="text-green font-bold">{{ booking.status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- {{ store.bookings }} -->
  </WebLayout>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue';
import { useBookingStore } from '@/stores/booking'; // Ensure this path is correct
const useBooking = useBookingStore();

export default {
  name: 'BookingList',
  components: {
    WebLayout
  },
  data() {
    return {
      store: useBookingStore(),
    };
  },
  mounted() {
    this.fetchBookings(); // Fetch all bookings on mount
  },
  methods: {
    fetchBookings(){
      useBooking.fetchAllBokkings();
    }
  }
};
</script>
