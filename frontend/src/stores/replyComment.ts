import { defineStore } from 'pinia';
import { fetchAllReplies, repliesComment, repliesdealete } from '@/api/replyComment';

export const useReplyStore = defineStore('replyComment', {
  state: () => ({
    replies: [],
  }),
  actions: {

    //get list replay id
    async fetchAllReplies(id:number) {
      try{
        const response = await fetchAllReplies(id);
        this.replies = response.data.data;        
      }catch(error){
        console.error('Failed to fetch posts:', error);
      }
    },

    // add replays
    async repliesComment(id:number,value:object) {
      try{
        const response = await repliesComment(id, value);
        this.replies = response.data.data;
      }catch(error){
        console.error('Failed to fetch posts:', error);
      }
    },
    
    async repliesdealete(id:number){
      try{
        const response = await repliesdealete(id);
        this.replies = response.data.data;
      }catch(error){
        console.error('Failed to fetch posts:', error);
      }
    }
  },
});