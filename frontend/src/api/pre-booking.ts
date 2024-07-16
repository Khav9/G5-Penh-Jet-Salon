import http from './api';

export function fetchAllCardService() {
  return http.get('/card/list');
}
export function listQRcodse() {
  return http.get('/card/list');
}

export function fetchAddCardService(id: number) {
  return http.post(`/card/add/${id}`);
}

export function deleteCardService(id: number) {
  return http.delete(`/card/remove/${id}`);
}
