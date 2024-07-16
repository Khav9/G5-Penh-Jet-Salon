import { defineStore } from 'pinia';
import { fetchAllBooking, store } from '@/api/booking';

export const useBookingStore = defineStore('booking', {
  state: () => ({
    bookings: [],
  }),
  actions: {
    async createBooking(formData: object) {
      try {
        const newBooking = await store(formData);
        this.bookings.push(newBooking);
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
    async fetchAllBokkings() {
      try {
        const bookings = await fetchAllBooking();
        this.bookings = bookings.data.data
      } catch (error) {
        console.error('Error creating booking:', error);
      }
    },
  },
});


