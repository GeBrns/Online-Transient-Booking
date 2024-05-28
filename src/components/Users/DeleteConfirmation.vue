<template>
  <div class="container">
    <div v-if="isDeleteVisible" class="delete-modal">
      <div class="delete-modal-content">
        <h2>Confirm Deletion</h2>
        <p>Are you sure you want to delete this user "{{ eventTitle }}"?</p>
        <div class="button-group">
          <button @click="closeModal">Cancel</button>
          <button @click="confirmDelete">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeleteConfirmation',
  props: {
    isDeleteVisible: {
      type: Boolean,
      required: true
    },
    eventId: {
      type: Number,
      required: true
    },
    eventTitle: {
      type: String,
      required: true
    }
  },
  methods: {
    confirmDelete() {
      // Emit the delete event with the eventId
      this.$emit('delete', this.eventId);
      // Close the modal
      this.closeModal();
    },
    closeModal() {
      this.$emit('close');
    }
  }
};
</script>

<style scoped>
.container {
  position: fixed;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  border-radius: 20px;
  top: 30%;
  left: 10%;
}

.delete-modal {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgb(250, 250, 250);
  width: 30%;
  height: 20vh;
  border-radius: 20px;
  box-shadow: 1px 2px 15px 4px rgba(0, 0, 0, 0.31);
}

.button-group {
  display: flex;
  align-items: end;
  justify-content: end;
}

button {
  margin-left: 20px;
  height: 40px;
  width: 100px;
  border-radius: 20px;
  border: none;
}

button:nth-child(2) {
  background-color: rgb(247, 6, 6);
}

button:nth-child(1) {
  background-color: aliceblue;
}

button:hover {
  transform: scale(1.1);
}
</style>
