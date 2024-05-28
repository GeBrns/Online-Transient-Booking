<template>
  <transition name="fade">
    <div v-if="isVisible" class="vue-modal">
      <div class="vue-modal-inner">
        <div class="vue-modal-content">
          <h2>Add Event</h2>
          <form @submit.prevent="addEvent">
            <div>
              <label for="name">Name:</label>
              <input type="text" id="title" v-model="title">
            </div>
            <div>
              <label for="start-date">Start Date:</label>
              <input type="date" id="start" v-model="start">
              <input type="time" id="startTime" v-model="startTime">
            </div>
            <div>
              <label for="end-date">End Date:</label>
              <input type="date" id="end" v-model="end">
              <input type="time" id="endTime" v-model="endTime">
            </div>
            <div>
              <label for="room">Room:</label>
              <select id="room" v-model="room">
                <option value="">Select Room</option>
                <option value="Room 1">Room 1</option>
                <option value="Room 2">Room 2</option>
                <option value="Room 3">Room 3</option>
              </select>
            </div>
            <div>
              <label for="note">Add Note:</label>
              <textarea id="note" v-model="note"></textarea>
            </div>
            <div class="buttonModal">
              <button type="button" id="close" @click="close">Close</button>
              <button type="submit" id="submit">Confirm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Modal',
  props: {
    isVisible: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      title: '',
      start: '',
      end: '',
      startTime: '',
      endTime: '',
      room: '',
      note: ''
    };
  },
  methods: {
    close() {
      this.$emit('close');
    },
    async addEvent() {
      const eventData = {
        title: this.title,
        start: this.start,
        end: this.end,
        room: this.room,
        note: this.note,
        startTime: this.startTime,
        endTime: this.endTime
      };

      try {
        const response = await axios.post('http://localhost/resort_fullstack/src/Api/bookingAPI.php', eventData);
        if (response.data.status) {
          // Emit an event to notify parent component
          this.$emit('eventAdded', { ...eventData, id: response.data.id });
          // Close the modal
          this.close();
        } else {
          console.error('Error adding event:', response.data.message);
          // Handle error (e.g., display an error message to the user)
        }
      } catch (error) {
        console.error('Error adding event:', error);
        // Handle error (e.g., display an error message to the user)
      }
    }
  }
};
</script>

<style scoped>
*,
::before,
::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

form {
  display: inline-block; 
  margin-bottom: 1.5rem;
  margin-top: 5px;
  margin-bottom: 20px;
  padding: 20px;
}

form input,
form select,
form textarea {
  margin-bottom: 10px; /* Adjust as needed */
}

.vue-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow-x: hidden;
  overflow-y: auto;
  background-color: rgba(0, 0, 0, 0.4);
  z-index: 1;
}

.vue-modal-inner {
  margin: 2rem auto;
}

.vue-modal-content {
  position: relative;
  background-color: #fff;
  border: .5px solid rgba(0, 0, 0, 0.3);
  border-radius: 1.5rem;
  padding: 1rem;
  max-width: 40%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, 10%);
}

button {
  display: inline-flex;
  justify-content: center;  
  border-radius: 5px;
  width: 70px;
  margin-left: 10px;
}

.buttonModal {
  display: flex;
  justify-content: flex-end;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.drop-in-enter-active,
.drop-in-leave-active {
  transition: all 0.3s ease-out;
}

.drop-in-enter-from,
.drop-in-leave-to {
  opacity: 0;
  transform: translate(0, -50px);
}
</style>
