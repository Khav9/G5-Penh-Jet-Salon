<template>
  <div class="m-5">
    <!-- Product Details Section -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="card">
            <div class="row g-0">
              <div class="col-md-6">
                <div class="img">
                  <img
                    :src="baseURL + serviceStore.service.image"
                    alt="Product Image"
                    class="w-full object-cover rounded-lg"
                    style="width: 500px; height: 300px;"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-body order-primary">
                  <h4 class="card-title">
                    Service: {{ serviceStore.service.service_name }}
                  </h4>
                  <div class="detail mb-3">
                    <h5 v-if="serviceStore.service.discount === null">
                      Price: <b class="text-pink-500">${{ serviceStore.service.price }}</b>
                    </h5>
                    <h5 v-else>
                      Discount: <b class="text-red"> ${{ serviceStore.service.discount }}</b> 
                    </h5>
                  </div>
                  <div class="d-flex justify-content-start ">
                    <h5>Rate:</h5>
                    <div v-for="star in 5" :key="star" class=" bi-star-fill text-orange pl-2"></div>
                  </div>
                  <div class="description mb-3">
                    <h5>Description: </h5>
                    <p>{{ serviceStore.service.description }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
   

    <!-- Comments Section -->
    <section class="py-10">
      <div class="container mt-5 color-black">
        <h3><i class="bi bi-chat-left-text text-pink-500 p-3"></i>Comments</h3>
        <div v-for="comment in useComment.comments" :key="comment.id" class="comment-box mb-4">
          <div class="d-flex align-items-start">
            <img :src="baseURL + comment.user_profile" alt="User Avatar" class="w-10 h-10 mr-2 " />
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <strong class=" mt-2 text-pink-500">
                  {{ comment.user_name }}
                </strong>
                <div>
                  <div>
                    <button class="btn btn-sm" @click="replyTo(comment)">
                        <svg class="w-6 h-6 text-blue-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.5 8.046H11V6.119c0-.921-.9-1.446-1.524-.894l-5.108 4.49a1.2 1.2 0 0 0 0 1.739l5.108 4.49c.624.556 1.524.027 1.524-.893v-1.928h2a3.023 3.023 0 0 1 3 3.046V19a5.593 5.593 0 0 0-1.5-10.954Z"/>
                        </svg>
                    </button>
                    <button class="btn btn-sm" @click="removeComment(comment.id)">
                      <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/><line x1="4" y1="7" x2="20" y2="7"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12"/><path d="M9 7v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <p>{{ comment.text }}</p>
              <img v-if="comment.image" :src="baseURL + comment.image" alt="User Avatar" class="rounded-circle me-3" width="50" />
              <div v-if="comment.replies && comment.replies.length" class="mb-3">
                <div v-for="reply in comment.replies" :key="reply.id" class="mb-2 card">
                  <!-- reply comment  -->
                  <div class="d-flex align-items-end reply bg-light p-3">
                    <!-- <img v-if="reply.owner.profile" :src="baseURL + reply.owner.profile" alt="User Avatar" class="rounded-circle me-3" width="50" /> -->
                    <div class="flex-grow-1 d-flex justify-content-between align-items-center">
                      <div class="comment-text">
                        <strong class="text-pink-500">{{ reply.owner.name }}:</strong> {{ reply.text }}
                      </div>
                      <div class="ms-auto">
                        <button class="btn btn-sm" @click="removeReply(reply.id)">
                          <svg class="h-6 w-6 text-red-500" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/><line x1="4" y1="7" x2="20" y2="7"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12"/><path d="M9 7v-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/>
                          </svg>
                        </button>
                      </div>
                    </div>
                    <img v-if="reply.owner.image" :src="baseURL + reply.owner.image" class="rounded-square ml-3" />
                  </div>
                </div>
              </div>
              <div v-if="comment.showReplyBox" class="d-flex align-items-center">
                <div class="input-group mb-2">
                  <input
                    type="text"
                    class="form-control flex-grow-1 "
                    placeholder="Add a reply..."
                    v-model="replyText"
                    @keyup.enter="addReply(comment)"
                  />
                  <button class="btn btn-primary" @click="addReply(comment)">
                    <i class="bi bi-arrow-right"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center mt-4 p-3">
          <div class="input-group mb-2">
            <!-- <input class="form-control" type="file" id="formFile" @change="handleFileUpload" /> -->
            <input
              type="text"
              class="form-control"
              placeholder="Add a comment..."
              v-model="commentAdd"
              @keyup.enter="addComment"
            />
            <button class="btn btn-primary" @click="addComment">
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>
      </div>
    </section>

  </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useServiceStore } from '../../../stores/service'
import { useCommentStore } from '../../../stores/comment'
import { useReplyStore } from '../../../stores/replyComment'
import baseURL from '../../../api/url'

const route = useRoute()
const serviceStore = useServiceStore()
const useComment = useCommentStore()
const useReply = useReplyStore()

// show the service
const fetchServiceShow = async () => {
  await serviceStore.getServiceShow(route.params.id)
}

//list all comments
const fetchAllComments = async () => {
  await useComment.fetchAllComments(route.params.id)
}

// delete comments
const removeComment = async (commentId) => {
  await useComment.deleteComments(commentId)
  fetchAllComments()
}

// delete replay
const removeReply = async (replyId) => {
  await useReply.repliesdealete(replyId)
  fetchAllComments()
}

const replyTo = (comment) => {
  comment.showReplyBox = !comment.showReplyBox 
}

// replay the comments
const replyText = ref("");
const addReply = async (comment) => {
  const reply = {
    text: replyText.value.toString(), 
  }
  useReply.repliesComment(comment.id, reply)
  replyText.value = ""
  fetchAllComments()
}

// comment the onwer
const commentAdd = ref("")
const addComment = async () => {
  const comment = {
    text: commentAdd.value.toString(),
  }
  useComment.addComments(route.params.id, comment)
  console.log(route.params.id, comment)
  commentAdd.value = ""
  fetchAllComments()
}

// routes showing
onMounted(async () => {
  fetchAllComments()
  fetchServiceShow()
})
</script>

<style scoped>

.card {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.card-body {
  padding: 30px;
}

.product-details h1 {
  font-size: 28px; 
  margin-bottom: 10px;
}

.product-details .price {
  color: #888;
  font-size: 24px;
  margin-bottom: 20px;
}

.product-details .description,
.product-details .detail {
  margin-bottom: 20px;
}

.quantity label {
  display: block;
  margin-bottom: 5px;
}

.comment-box {
  border: 1px solid #ddd;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
  background-color: #f9f9f9;
  transition: transform 0.3s ease-in-out; /* Add transition for smooth effect */
}

.comment-box img {
  border-radius: 50%;
}

@media (max-width: 768px) {
  .background-gradient {
    padding: 15px;
  }
  .card-body {
    padding: 15px;
  }
  .product-details h1 {
    font-size: 24px;
  }
  .product-details .price {
    font-size: 20px;
  }
}
</style>