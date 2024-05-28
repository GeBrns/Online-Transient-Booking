<template>

  <div class="background-container"> </div>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <h1 class="logo">Logo</h1>
        <button class="navbar-toggler" type="button" @click="toggleMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-dark" :class="{ 'show': isMenuVisible }">
          <ul class="navbar-nav">
            <li class="nav-item">
              <li class="nav-item">
              <a class="nav-link" href="#" @click="toggleLink">Home</a>
            </li>
              <a class="nav-link" href="#about-section" @click="toggleLink">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#room-section" @click="toggleLink">Room</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-section" @click="toggleLink">Contact</a>
            </li>
            <li class="nav-item">
              <router-link to="/LoginView" @click.prevent="toggleLogin">Login</router-link>
            </li>
          </ul>
        </div>
        <ul class="large-menu">
          <li><a href="#">Home</a></li>
          <li><a href="#about-section">About</a></li>
          <li><a href="#room-section">Room</a></li>
          <li><a href="#contact-section">Contact</a></li>
          <li>
            <router-link class="nav-link" to="/LoginView" @click.prevent="toggleLogin">Login</router-link>
          </li>
        </ul>
      </div>
    </nav>
    <div class="center">
      <div class="search-container">
        <h2>Discover Available Rooms</h2>
        <form @submit.prevent="search">
          <div class="form-group">
            <label for="startDate">From:</label>
            <input type="date" v-model="startDate">
          </div>
          <div class="form-group">
            <label for="endDate">To:</label>
            <input type="date" v-model="endDate">
          </div>
          <div class="form-group">
            <label for="guestCount">Number of Guest:</label>
            <input class="guest-number" type="number" v-model="guestCount">
          </div>
          <div class="search-button">
            <button type="submit" class="btn btn-success">Search</button>
          </div>
        </form>
      </div>
    </div>

    <LoginView v-if="isLoginVisible" />

    <div id="about-section">
    <About />
    </div>

    <div id="room-section">
    <Room />
    </div>

    <div id="contact-section">
      <ContactUs />
    </div>
 
  
    <router-view></router-view>
</template>

<script>

import LoginView from '@/components/Login/LoginView.vue';
import About from '@/components/landingpage/About.vue';
import Room from '@/components/landingpage/Room.vue';
import ContactUs from '@/components/landingpage/ContactUs.vue';
import Room1 from '@/components/landingpage/Rooms/Room1.vue';
import { mapActions } from 'vuex';


export default {
  name: 'LandingPage',
  components: {
     LoginView,
    About,
    Room,
    ContactUs,
    Room1,

  },
  data() {
    return {
      startDate: '',
      endDate: '',
      guestCount: 0,
      isMenuVisible: false,
      isLoginVisible: false,
    };
  },
  methods: {

    ...mapActions(['updateReservationData']),
    search() {
      this.$store.dispatch('updateReservationData', {
        startDate: this.startDate,
        endDate: this.endDate,
      });
      console.log(this.$store.state.startDate, this.$store.state.endDate);
      if (this.guestCount === 2) {
        this.$router.push({ name: 'Room1' });
      }
    },
    toggleMenu() {
      this.isMenuVisible = !this.isMenuVisible;
    },
    toggleLogin() {
      this.isLoginVisible = !this.isLoginVisible;
    },
    toggleLink() {
      this.isMenuVisible = false;
    },
  },
  };
</script>


<style scoped>
body {
  padding: 0;
  margin: 0;
}

html{
    scroll-behavior: smooth;
  }

.background-container {
  background-image: url("../assets/img/laverdehCover.png");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  font-family: Arial, Helvetica, sans-serif;
  box-sizing: border-box;
  height: 100vh;
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  z-index: -1;
}

nav {
  position: fixed;
  height: 10vh;
  width: 100%;
  top: 0;
  z-index: 1;
}


.navbar{
  background-color: rgba(0, 0, 0, 0.75);
}

.collapse{
  background-color: rgba(0, 0, 0, 0.354);
  width: 100%;
}

.navbar-nav{
  text-align: center;
  
}
.navbar-nav a{
  color: beige;
}
.navbar-nav a:hover{
  color: aquamarine;
}

.logo {
  font-size: 24px;
  color: white;
}

.large-menu {
  display: none; /* Hide large menu by default */
}

.large-menu li {
  list-style: none;
  margin-top: 10px;
  font-size: 20px;
  padding: 10px;
}

.large-menu a {
  text-decoration: none;
  font-style: none;
  color: beige;
  font-weight: 600;
}

.large-menu a:hover{
  color: aquamarine;
}

.LoginView{
  display: none;
}

#about-section{
  margin-top: 100vh;
}

.center{
  display: flex;
  align-items: center;
  justify-content: center;
}

.search-container{
  position: relative;
  margin-top: 20vh;
  height: 120px;
  width: 450px;
  background-color: rgba(255, 255, 255, 0.907);
  border-radius: 8px;
    h2{
      margin-top: 10px;
      font-size: 15px;
      text-align: center;
      font-weight: 600;
    }
    form{
      margin-top: 2px;
      display: flex;
      align-items: start;
      margin-left: 45px;
      font-size: .7rem;
      width: 100%;
      height: 100px;
      gap: 10px;
    }
    input{
      width: 100px;
      height: 20px;
    }
    .search-button{
      position: absolute;
      top: 70%;
      left: 30%;
      button{
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        height: 30px;
        width: 200px;
      }
    }
}

/* Show large menu on screens larger than or equal to 992px 
  hide navbar-nav
*/
@media (min-width: 992px) {
  .navbar-nav{
    display: none;
  }
  .large-menu {
    display: flex; 
    gap: 30px;
  }

  
  
}
</style>
