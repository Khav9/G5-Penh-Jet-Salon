<template>
  <v-app class="bg-pink-500">
    <v-container>
      <div class="container-lg mt-4">
        <div class="d-flex flex-row justify-content-center">

          <!-- Your Order Card -->
          <div class="col-md-5 card p-3 mx-3 bg-light max-h-145 overflow-y-auto">
            <div>
              <h3 class="card-title text-center p-2 ">Your Order From</h3>
            </div>
            <hr>
            <div v-if="cardItems.cards.length > 0" class="card p-3 rounded">
              <div v-for="item in cardItems.cards" :key="item.id">
                <p><strong>Service Name: {{ item.service.service_name }}</strong></p>
                <p v-if="item.service.discount"><strong>Price: ${{ item.service.discount }}</strong></p>
                <p v-else><strong>Price: ${{ item.service.price }}</strong></p>
                <p><strong>Quantity: {{ item.quantity }}</strong> </p>
                <hr class="border-pink-500">
              </div>
            </div>
            <div v-else class="text-center text-red font-semibold my-4">
              Your cart is empty!!
            </div>
            <div class="flex justify-between items-center mt-5">
              <h3 class="font-semibold text-gray-900">Total:</h3>
              <h3 class="text-gray-900 text-pink-600 font-bold">${{ calculateTotalPrice() }}</h3>
            </div>
          </div>

          <!-- Payment Form -->
          <div class="col-md-7 mx-3">
            <div class="card ">
              <div class="card-body">
                <h3 class="card-title text-center mb-4">PAYMENT SERVICE</h3>
                <div v-if="userAuth.isAuthenticated">

                  <form @submit.prevent="bookingService">
                    <div class="mb-3">
                      <label for="fullName" class="form-label"><strong>User Name: </strong></label>
                      <input disabled type="text" id="fullName" class="form-control" :value="userAuth.user.name"
                        required />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label"><strong>Email:</strong></label>
                      <input disabled type="email" id="email" class="form-control" :value="userAuth.user.email"
                        required />
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label"><strong>Phone Number:</strong></label>
                      <input type="tel" id="phone" class="form-control" :value="userAuth.user.phone" required />
                    </div>

                    <div class="row mb-3">
                      <!-- Date  -->
                      <div class="col-md-6">
                        <label for="date" class="form-label"><strong>Date:</strong></label>
                        <input type="date" id="date" class="form-control" v-model="date" required />
                      </div>
                      <!-- Time  -->
                      <div class="col-md-6">
                        <label for="time" class="form-label"><strong>Time:</strong></label>
                        <input type="time" id="time" class="form-control" v-model="time" required />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="pay" class="form-label"><strong>Total Price: ${{ calculateTotalPrice() }}</strong></label>
                        <input type="number" id="pay" class="form-control" disabled />
                      </div>
                      <div class="col-md-6">
                        <div class="mt-2 d-flex flex-row gap-4 align-items-center">
                          <img class="w-15 h-50" src="../../../Images/aba.webp" data-bs-toggle="modal" data-bs-target="#exampleModalABA" alt="QR Scan ABA" @click="addQR(id)">
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="bg-pink-600 text-white p-2 mt-5 rounded transition-colors duration-300 btn-sm w-20 h-10">
                          Submit
                        </button>
                      </div>
                      <!-- ABA Modal -->
                      <div class="modal fade " id="exampleModalABA" tabindex="-1" aria-labelledby="exampleModalLabelABA" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabelABA">ABA QR</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center my-8" v-for="QR in cardItems.QR" :key="QR.id">
                              <img class="w-80 h-80" :src="baseURL + QR.qr_code" alt="QR Scan ABA">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </v-app>
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useServiceStore } from '../../../stores/service';
import { useCardStore } from '../../../stores/pre-booking';
import { useAuthStore } from '../../../stores/auth-store';
import { useBookingStore } from '../../../stores/booking';
import { useField, useForm } from 'vee-validate';
import {useListQR} from '../../../stores/QRCode';
import baseURL from '../../../api/url'

import * as yup from 'yup';

const userAuth = useAuthStore()
const route = useRoute();
const serviceStore = useServiceStore();
const cardItems = useCardStore();
const userBooking = useBookingStore();
const QRCode = useListQR();

const addQR = async (id) => {
  await QRCode.fetchAllQRs(id);
};

const calculateTotalPrice = () => {
  let totalPrice = 0;
  cardItems.cards.forEach(item => {
    if (!item.service.discount) {
      totalPrice += item.service.price * item.quantity;
    } else {
      totalPrice += item.service.discount * item.quantity;
    }
  });
  return totalPrice;
};

const fetchService = async () => {
  const id = route.params.id;
  await serviceStore.getService(id);
};

const fetchAllCardService = async () => {
  await cardItems.fetchAllCards();
};
const listQR = async () => {
  await cardItems.listQR();
};


onMounted(async () => {
  fetchService();
  fetchAllCardService();
  listQR();
});

const formSchema = yup.object({
  date: yup.date().required().label('Date'),
  time: yup.string().required().label('Time'),
  pay: yup.number().required().label('Total Price')
});

const { handleSubmit } = useForm({
  validationSchema: formSchema
});

const { value: date, errorMessage: dateError } = useField('date');
const { value: time, errorMessage: timeError } = useField('time');
const { value: pay, errorMessage: totalError } = useField('pay');

const bookingService = handleSubmit(async (values) => {
  try {
    await userBooking.createBooking(values);
    window.alert('You successfully created a booking!');
    window.location.href = '/'; 
  } catch (error) {
    console.error('Error creating booking:', error);
    window.alert('There was an error creating your booking. Please try again later.');
  }
});

</script>