import http from './api';

export function fetchAllComment(id:number) {
  return http.get(`comment/list/${id}`);
}
export function createComment(id:number,value:object) {
  return http.post(`comment/create/${id}`,value);
}
export function deleteComment(id:number) {
  return http.delete(`comment/delete/${id}`);
}