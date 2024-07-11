import http from './api';

export function fetchAllReplies(id: number) {
  return http.get(`reply/list/${id}`);
}
export function repliesComment(id:number,value:object) {
  return http.post(`reply/${id}`, value);
}