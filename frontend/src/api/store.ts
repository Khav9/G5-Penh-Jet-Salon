import http from './api'

export function fetchAllStore(id:number) {
  return http.get('/store/list/'+ id)
}