import http from './api';

export function fetchAllServiceOwner() {
  return http.get('/service/list');
}

export function fetchAllService(id: number) {
  return http.get(`/service/list/${id}`);
}

export function createService(value: object) {
  return http.post('/service/create', value);
}

export function deleteService(id: number) {
  return http.delete(`/service/destroy/${id}`);
}

export function showService(id: number) {
  return http.get(`/service/show/${id}`);
}