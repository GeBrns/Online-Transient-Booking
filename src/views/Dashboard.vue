<template>
  <div class="nav-container">
    <nav class="navbar">
      <h1>Dashboard</h1>
      <ul>
        <li><router-link to="/dashboard/appointment">Appointment</router-link></li>
        <li><router-link to="/dashboard/userList">UserList</router-link></li>
        <li class="logout"><a href="#" @click.prevent="logout">Logout</a></li>
      </ul>
    </nav>
    <router-view/>
  </div>
</template>

<script>
import { useRouter } from 'vue-router';
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import Appointment from '@/components/dashboard/Appointment.vue';
import UserList from '@/components/dashboard/UserList.vue';

export default {
  name: "Dashboard",
  components: {
    Appointment,
    UserList,
  },

  setup() {
    const router = useRouter();
    const store = useStore();

    // Computed property to check authentication status
    const isAuthenticated = computed(() => store.getters.isAuthenticated);

    // Function to redirect based on authentication status
    const handleRedirect = () => {
      if (!isAuthenticated.value) {
        router.push({ name: 'LoginView' });
        console.log(isAuthenticated.value);
      }
    };

    // Logout function
    const logout = () => {
      // Clear authentication token from local storage
      localStorage.removeItem('authToken');
      // Redirect to login page
      router.push({ name: 'LandingPage' });
    };

    // Call redirect function when component is mounted
    onMounted(() => {
      handleRedirect();
    });

    return {
      isAuthenticated,
      logout
    };
  }
}
</script>

<style scoped>
/* Your styles here */
</style>





<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
}

.nav-container {
  display: flex;
  height: 100vh;
}

.navbar {
  width: 250px;
  background-color: #333;
  color: #fff;
  padding: 20px;
  display: flex;
  flex-direction: column;
  justify-content: flex-start; /* Ensure items are at the top */
  align-items: flex-start; /* Align items to the start */
}

h1 {
  margin-bottom: 20px;
  font-size: 24px;
  color: #fff;
}

ul {
  list-style-type: none;
  padding: 0;
  width: 100%;
  display: flex;
  flex-direction: column;
}

li {
  margin-bottom: 10px;
}

a {
  text-decoration: none;
  color: #fff;
  font-size: 18px;
  display: block;
  padding: 10px 0;
}

a:hover {
  background-color: #575757;
  border-radius: 4px;
}

.content {
  flex-grow: 1;
  padding: 20px;
}

.logout{
  
  text-align: center;
  margin-top: 250%;
}
</style>
