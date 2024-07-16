import { createRouter, createWebHistory } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
import { createAcl, defineAclRules } from 'vue-simple-acl'

const simpleAcl = createAcl({})
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/admin/dashboard',
      name: 'dashboard',
      component: () => import('../views/Admin/DashboardView.vue'),
      meta: {
        requiresAuth: true,
        role: 'admin'
      }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Admin/Auth/LoginView.vue')
    },
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Web/HomeView.vue')
      // component: () => import('../views/Shops/ListShopView.vue')
    },
    {
      path: '/post',
      name: 'post',
      component: () => import('../views/Web/Post/ListView.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Users/Registers/RegisterView.vue')
    },
    {
      path: '/profile',
      name: 'profile',
      component: () => import('../Components/Profile/Profile.vue')
    },
    {
      path: '/payment',
      name: 'payment',
      component: () => import('../views/Users/Shops/Payment/ServicePayment.vue'),
    },
    {
      path: '/history',
      name: 'history',
      component: () => import('../views/Users/History/HistoryBooking.vue')
    },
    // =================ShopOwner=================
    {
      path: '/registerOwner',
      name: 'registerOwner',
      component: () => import('../views/Users/RegisterOwner/RegisterOwner.vue')
    },

    {
      path: '/infoDetail',
      name: 'infoDetail',
      component: () => import('../views/Users/RegisterOwner/InforDetail.vue')
    },

    {
      path: '/listShop/:id',
      name: 'listShop',
      component: () => import('../views/Users/Shops/ListShops.vue'),
      props: true
    },
    {
      path: '/listService/:id',
      name: 'listService',
      component: () => import('../views/Users/Shops/ListService.vue'),
      props: true
    },
    // {
    //   path: '/listBooking',
    //   name: 'listBooking',
    //   component: () => import('../Components/OwnerPage/Booking/ListBooking.vue'),
    // },
    {
      path: '/message',
      name: 'message',
      component: () => import('../views/ShopOwner/Message/Message.vue')
    },
    {
      path: '/comment/:id',
      name: 'comment',
      component: () => import('../views/Users/Shops/Comment/CommentService.vue'),
      props: true

    },
  ],
  linkExactActiveClass: 'bg-danger text-white border-bottom',
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/']
  const authRequired = !publicPages.includes(to.path)
  const store = useAuthStore()

  try {
    const { data } = await axiosInstance.get('/me')

    store.isAuthenticated = true
    store.user = data.data

    store.permissions = data.data.permissions.map((item: any) => item.name)
    store.roles = data.data.roles.map((item: any) => item.name)

    const rules = () =>
      defineAclRules((setRule) => {
        store.permissions.forEach((permission: string) => {
          setRule(permission, () => true)
        })
      })

    simpleAcl.rules = rules()
  } catch (error) {
    /* empty */
  }

  if (authRequired && !store.isAuthenticated) {
    next()
    
  } else {
    next()
  }
})

export default { router, simpleAcl }
