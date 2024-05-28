<template>
  <div class="control-container">
    <div class="container">
      <Carousel id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
        <Slide v-for="(photo, index) in photos" :key="index">
          <a :href="'/src/assets/RoomImage/img' + (index + 1) + '.png'">
            <img :src="photo" :alt="'Room Image ' + (index + 1)">
          </a>
        </Slide>
        <template #addons>
          <Navigation />
          <Pagination />
        </template>
      </Carousel>

      <div class="icon-container">
        <img src="/src/assets/Icons/person.svg" alt="Person" width="30px" height="26px"> <h3>2</h3>
        <img src="/src/assets/Icons/bed.svg" alt="Bed" width="30px" height="30px"> <h3>1</h3>
        <img src="/src/assets/Icons/comfort room.svg" alt="Comfort Room" width="30px" height="30px"> <h3>1</h3>
        <img src="/src/assets/Icons/air conditioner.svg" alt="Air Conditioner" width="30px" height="30px"> <h3>1</h3>
      </div>

      <div class="room-details">
        <div class="text">
          <h3>Room Description:</h3>
          <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque voluptatem provident architecto repellat doloremque ratione delectus, sequi, reprehenderit tempora praesentium molestiae ab explicabo aut ad similique nulla. Perferendis, impedit distinctio!
              Tempora velit earum, dolorum natus dolores, saepe nostrum, eligendi quidem commodi odit iusto! Porro cum illum dicta nesciunt id voluptate odio ipsam ex neque debitis. Blanditiis odio vero officia quae.
          </h5>
        </div>
      </div>

      <div class="form-container">
        <form @submit.prevent="submitForm">
          <div class="title">
            <span>Reserve Your Room - Fill Out the Form Now!</span>
          </div>

            <hr>

          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" v-model="name">
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" v-model="email">
          </div>

          <div class="form-group">
            <label for="number">Phone Number:</label>
            <input type="tel" class="form-control" id="number" placeholder="Enter phone number" name="number" v-model="phoneNumber">
          </div>

          <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="startDate" name="startDate" v-model="startDate">
            <label for="date">Time:</label>
            <input type="time" class="form-control" id="startTime" name="startTime">
          </div>

          <div class="form-group">
            <label for="date">Until:</label>
            <input type="date" class="form-control" id="endDate" name="endDate" v-model="endDate">
          </div>

          <div class="input-group">
            <span class="input-group-text">Message</span>
            <textarea class="form-control" id="message" aria-label="With textarea"></textarea>
          </div>

          <div class="button-container">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';
import { defineComponent, watch } from 'vue';
import { Carousel, Slide, Navigation, Pagination } from 'vue3-carousel';

import 'vue3-carousel/dist/carousel.css';

import image1 from '@/assets/RoomImage/img1.png';
import image2 from '@/assets/RoomImage/img2.png';
import image3 from '@/assets/RoomImage/img3.png';
import image4 from '@/assets/RoomImage/img4.png';
import image5 from '@/assets/RoomImage/img5.png';

export default defineComponent({
  name: 'Room1',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data() {
    return {
      photos: [
        image1,
        image2,
        image3,
        image4,
        image5,
      ],
      name: '',
      email: '',
      phoneNumber: '',
      startDate: '',
      endDate: '',
      currentSlide: 0,
    };
  },
  computed: {
    ...mapState(['startDate', 'endDate']),
  },
  watch: {
    startDate(newValue) {
      this.startDate = newValue;
    },
    endDate(newValue) {
      this.endDate = newValue;
    },
  },
  methods: {
    submitForm() {
      // Handle form submission
      console.log('Form submitted with:', {
        name: this.name,
        email: this.email,
        phoneNumber: this.phoneNumber,
        startDate: this.startDate,
        endDate: this.endDate,
      });
    },
    slideTo(index) {
      // Update the current slide
      this.currentSlide = index;
    },
  },
  mounted() {
    // Initialize startDate and endDate with store values when component is mounted
    this.startDate = this.$store.state.startDate;
    this.endDate = this.$store.state.endDate;
  },
});
</script>

  <style scoped>

  body{
    margin: 0;
    padding: 0;
  }

  .control-container{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    background-color: aliceblue;
  }

  .container{
    display: flex;
    flex-direction: column;
    height: 100%;
    min-width: 320px;
    border-radius: 8px;
    
  }

  .carousel{
    width: 100%;
    height: 360px;
    background-color: white;
    border-radius: 8px;
  }

  .slide{
    border-radius: 20px;
  }

  #gallery{
    margin-top: 20px;
  }

  #gallery img{
    width: 450px;
    height: 300px;
    border-radius: 8px;
    margin-top: 10px;
  }

  .icon-container{
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 30px;
    gap: 20px;
  }

 .icon-container img{
    margin-left: 20px;
  }

  .room-details{
    display: flex;
    flex-direction: column;
    text-align: center;
    width: 100%;
    margin-top: 30px;
    background-color:azure;
    border-radius: 8px;
      .text{
        width: 90%;
        margin-left: 20px;
      }
      h3{
        text-align: start;
        font-size: 15px;
        font-weight: 400;
      }
      h5{
        font-size: 12px;
        font-weight: 100;
        font-family: Arial, Helvetica, sans-serif;
        text-align: start;
      }
  }

  .form-container {
    display: flex;
    justify-content: center;
    align-items: center; 
    margin-top: 50px; 
      input{
      width: 400px;
      height: 30px;
      }
      span{
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        font-weight: 500;
      }
      .input-group{
        margin-top: 5px;
      }
      .button-container{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
          button{
            width: 200px;
            font-size: 15px;
            border-radius: 20px;
            margin-bottom: 20px;
          }
      }
  }
  

  </style>
  