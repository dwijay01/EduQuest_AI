import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'landing',
      component: () => import('../views/LandingPage.vue'),
      meta: { title: 'EduBridge AI - Belajar Seru dengan AI!' }
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/auth/LoginPage.vue'),
      meta: { title: 'Login - EduBridge AI' }
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/auth/RegisterPage.vue'),
      meta: { title: 'Daftar - EduBridge AI' }
    },
    {
      path: '/onboarding',
      name: 'onboarding',
      component: () => import('../views/onboarding/OnboardingPage.vue'),
      meta: { title: 'Setup Profil Anak - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/baseline-test',
      name: 'baselineTest',
      component: () => import('../views/onboarding/BaselineTest.vue'),
      meta: { title: 'Yuk Kenalan Dulu! - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/student',
      name: 'studentDashboard',
      component: () => import('../views/student/StudentDashboard.vue'),
      meta: { title: 'Dashboard - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/learn/:topicId',
      name: 'learningSession',
      component: () => import('../views/student/LearningSession.vue'),
      meta: { title: 'Belajar - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/parent',
      name: 'parentDashboard',
      component: () => import('../views/parent/ParentDashboard.vue'),
      meta: { title: 'Dashboard Orang Tua - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/parent/reports',
      name: 'parentReports',
      component: () => import('../views/parent/ReportsPage.vue'),
      meta: { title: 'Laporan Progress - EduBridge AI', requiresAuth: true }
    },
    {
      path: '/subscribe',
      name: 'subscribe',
      component: () => import('../views/SubscribePage.vue'),
      meta: { title: 'Berlangganan - EduBridge AI' }
    }
  ]
})

// Update document title on route change
router.beforeEach((to, from, next) => {
  document.title = to.meta.title || 'EduBridge AI'
  next()
})

export default router
