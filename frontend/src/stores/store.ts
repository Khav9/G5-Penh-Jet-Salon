
import { fetchAllStore } from '@/api/store';
import { defineStore } from 'pinia'

export const useSalonStore = defineStore('store', {
  state: () => ({
    stores: [],
    province:null
  }),
  actions: {
    async getAllStores(id:number) {
      try {
        const response = await fetchAllStore(id);
        this.stores = response.data.data; 
        this.province = response.data.data[0].address.province.province_name;
        
        
      } catch (error) {
        console.error('Failed to fetch posts:', error);
      }
    },
}
})
