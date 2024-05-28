import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login/LoginView.vue';
import Dashboard from "../views/Dashboard.vue";
import Appointment from '../components/dashboard/Appointment.vue';
import UserList from '../components/dashboard/UserList.vue';
import LandingPage from '../views/landingPage.vue';
import store from '@/auth/store'; // Import the Vuex store
import { getCurrentUser } from '@/auth/auth';
import Room1 from '@/components/landingpage/Rooms/Room1.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/landingPage',
      name: 'LandingPage',
      component: LandingPage
    },
    {
      path:'/room1',
      name: 'Room1',
      component: Room1
    },
    {
      path: '/loginView', 
      name: 'LoginView',
      component: Login,
      meta: { auth: false },
    },
    {
      path: '/dashboard',
      name: "Dashboard",
      component: Dashboard,
      meta: { requiresAuth: true },
      children: [
        {
          path: 'appointment', 
          name: 'Appointment',
          component: Appointment
        },
        {
          path: 'userList', 
          name: 'UserList',
          component: UserList
        },
      ]
    }
  ]
});

// Navigation guard
router.beforeEach(async (to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  if (requiresAuth && !(await getCurrentUser())) {
    // Redirect to the login page if authentication is required but the user is not logged in
    next({
      path: '/loginView',
      query: { redirect: to.fullPath }
        })
  
  } else {
    // Proceed to the requested route
    next();
  }
});


export default router;
