import { defineStore } from 'pinia'
import { addFavorite, fetchAllLikes, getIsFavorite } from '@/api/like';


export const useLikeStore = defineStore('like', {
  state: () => ({
    likedServices: [],
    totalLike: '',
    isFavorited: false,
  }),
  actions: {
    async addToFav(service_id:number) {
      try {
        const response = await addFavorite(service_id);
        this.likedServices = response.data.data; 
      } catch (error) {
        console.error('Failed to fetch likes:', error);
      } 
    },
    async fetchFavorite(service_id:number) {
      try {
      const response = await fetchAllLikes(service_id);
      this.totalLike = response.data.data;
      }catch (error) {
        console.error('Failed to fetch likes:', error);
      } 
    },
    async isServiceFavorite(service_id:number) {
      try {
      const response = await getIsFavorite(service_id);
      this.isFavorited = response.data.data ? true : false;
      }catch (error) {
        console.error('Failed to fetch likes:', error);
      } 
    }
  }
})