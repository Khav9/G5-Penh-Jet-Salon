import http from './api'

export function fetchAllQR(id:number) {
  return http.get(`/list/QR/${id}`)
}