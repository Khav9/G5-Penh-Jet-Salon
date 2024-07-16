import { defineStore } from 'pinia'
import { createComment, deleteComment, fetchAllComment } from '@/api/comment'

export const useCommentStore = defineStore('comment', {
    state: () => ({
      comments: [],
    }),
    actions: {
      async fetchAllComments(id:number) {
        try{
          const response = await fetchAllComment(id);
          this.comments = response.data.data;
        }catch(error){
          console.error('Failed to fetch posts:', error);
        }
      },
      async addComments(id:number,value:object) {
        try{
          const response = await createComment(id,value);
          this.comments = response.data.data;
        }catch(error){
          console.error('Failed to fetch posts:', error);
        }
      },
      async deleteComments(id:number) {
        try{
          const response = await deleteComment(id);
          this.comments = response.data.data;
        }catch(error){
          console.error('Failed to fetch posts:', error);
        }
      },
    },
    
  });