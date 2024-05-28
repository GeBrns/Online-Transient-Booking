<template>
  <div class="calendar-container">
    <FullCalendar :options="calendarOptions" />
    <Modal 
      :isVisible="isVisible" 
      @close="closeModal" 
      @addEvent="handleEventAdded" 
    />
  </div>
</template>

<script>
import Modal from "@/components/EventModal.vue";
import FullCalendar from '@fullcalendar/vue3';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';
import listPlugin from '@fullcalendar/list';
import axios from 'axios';
import { ref, reactive, onMounted } from 'vue';

export default {
  name: 'Appointment',
  components: { FullCalendar, Modal },
  setup() {
    const isVisible = ref(false);
    const calendarOptions = reactive({
      headerToolbar: {
        left: 'prev next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin],
      initialView: 'dayGridMonth',
      events: [],
      navLinks: true,
      editable: true,
      selectable: true,
      nowIndicator: true,
      dayMaxEvents: true,
      dateClick: null,
      height: '100%',
    });

    onMounted(() => {
      fetchEvents();
    });

    const fetchEvents = async () => {
      try {
        const response = await axios.get('http://localhost/resort_fullstack/src/Api/bookingAPI.php');
        calendarOptions.events = response.data.data.map(event => ({
          id: event.event_id,
          title: event.title,
          start: new Date(event.start).toISOString(),
          end: event.end ? new Date(event.end).toISOString() : null,
          backgroundColor: event.color,
          textColor: 'black'
        }));
      } catch (error) {
        console.error('Error fetching events:', error);
      }
    };

    const openModal = () => {
      isVisible.value = true;
    };

    const closeModal = () => {
      isVisible.value = false;
    };

    const handleEventAdded = async (eventData) => {
      calendarOptions.events.push({
        id: eventData.id,
        title: eventData.title,
        start: eventData.start,
        end: eventData.end,
        backgroundColor: '#378006',
        textColor: 'black'
      });
      closeModal();
    };

    const handleDateClick = (arg) => {
      openModal();
    };

    const handleEventClick = (arg) => {
      console.log('Event clicked:', arg.event);
      openModal();
    };

    calendarOptions.dateClick = handleDateClick;
    calendarOptions.eventClick = handleEventClick;

    return { isVisible, calendarOptions, openModal, closeModal, handleEventAdded };
  }
};
</script>

<style scoped>
.calendar-container {
  width: 100%;
  height: 80%;
  margin-top: 10vh;
}




</style>
