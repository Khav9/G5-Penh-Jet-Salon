import { defineStore } from 'pinia';
import { fetchAllCardService, fetchAddCardService, deleteCardService, listQRcodse } from '@/api/pre-booking';

export const useCardStore = defineStore('pre-booking', {
  state: () => ({
    cards: [],
    QR:[],
  }),
  actions: {
    async listQR (){
      try{
        const response = await listQRcodse();
        this.QR = response.data.qrOwner;
      }catch(error){
        console.error('Failed to fetch posts:', error);
      }

    },
    async fetchAllCards() {
      try{
        const response = await fetchAllCardService();
        this.cards = response.data.data;
      }catch(error){
        console.error('Failed to fetch posts:', error);
      }
    },
    async addCard(id: number) {
      try {
        const response = await fetchAddCardService(id)
        this.cards = response.data.data; 
        this.fetchAllCards();
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
    async removeCard(id: number) {
      await deleteCardService(id);
      this.fetchAllCards();
    },
  },
});