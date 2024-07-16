import { defineStore } from 'pinia'
import { createService, deleteService, fetchAllService, fetchAllServiceOwner, showService } from '@/api/service'

export const useServiceStore = defineStore('service', {
  state: () => ({
    services: [],
    serviceOwner: [],
    service: [],

  }),
  actions: {
    async getService(id:number) {
      try {
        const response = await fetchAllService(id)
        this.services = response.data.data
      } catch (error) {
        console.error('Error fetching services:', error)
      }
    },
    async getServiceOwner() {
      try {
        const response = await fetchAllServiceOwner()
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    },
    async createServiceOwner(value:object){
      try {
        const response = await createService(value)
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    },
    async deleteserviceOwner(id:number){
      try {
        const response = await deleteService(id)
        this.serviceOwner = response.data.data
      } catch (error) {
        console.error('Error fetching service owner:', error)
      }
    },
    async getServicebyIdCategory(id:number) {
      const url = window.location.href;
      const rout_id = url.substring(url.lastIndexOf('/') + 1);
      await this.getService(rout_id);
      const data:[] = [];
      this.services.forEach(element => {        
        if (element.category_id === id) {
          data.push(element);
        }
      });
      this.services = data;
    },
    async getServiceShow(id:number) {
      try {
        const response = await showService(id)
        this.service = response.data.data
      } catch (error) {
        console.error('Error fetching services:', error)
      }
    },
  }
})