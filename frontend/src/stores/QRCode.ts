import { defineStore } from 'pinia'
import { fetchAllQR } from '@/api/QRCode'

export const useListQR = defineStore('QRCode', {
  state: () => ({
    QR: []
  }),
  actions: {
    async fetchAllQRs(id:number) {
      try {
        const response = await fetchAllQR(id)
        this.QR = response.data.data
      } catch (error) {
        console.error('Error fetching services:', error)
      }
    },
    }
})