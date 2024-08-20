import { createRouter, createWebHistory } from 'vue-router'
import LoginView from "@/views/LoginView.vue";
import RegisterView from "@/views/RegisterView.vue";
import ProfileView from "@/views/ProfileView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'profile',
      meta: { requiresAuth: true },
      component: ProfileView
    },
    {
      path: '/login',
      name: 'login',
      hideNav: true,
      component: LoginView
    },
    {
      path: '/registration',
      name: 'registration',
      hideNav: true,
      component: RegisterView
    },

  ]
})

export default router
