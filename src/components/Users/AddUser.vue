<template>
    <transition name="fade">
    <div v-if="isAddUserVisible" class="form-container">
       
        <form @submit.prevent="submitForm">
            <h1>Add User</h1>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" v-model="UsersData.name" class="form-control" id="name" placeholder="">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text" v-model="UsersData.email" class="form-control" id="email" placeholder="" autocomplete="email">
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" v-model="UsersData.contact" class="form-control" id="contact" placeholder="">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" v-model="UsersData.password" class="form-control" id="password" placeholder="" autocomplete="current-password">
            </div>
            <div class="button">
              <button type="button" id="close" @click="close">Close</button>
              <button type="submit" id="submit">Confirm</button>
            </div>

        </form>
    </div>
</transition>
</template>

<script>


export default{
    name: 'AddUser',
    props: {
    isAddUserVisible: {
      type: Boolean,
      required: true
    }
  },

  data() {
    return{
    UsersData: {
        name: null,
        email: null,
        contact: null,
        password: null,
    },
 
    }
  },

  methods: {
    submitForm() {
      this.$emit('submit', this.UsersData);
    },
     // Add User Modal
     addUsers() {
        this.UsersData = {
          name: null,
          email: null,
          contact: null,
          password: null,
        };
     },
      
    close() {
      this.$emit('close');
    },
}
}

</script>

<style scoped>
form{
    width: 70%;
    margin-top: 20px;
}
h1{
    margin-top: -50px;
    margin-left: -60px;
}
.form-container{
    position: fixed;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    top: 20%;
    left: 40%;
    width: 30%;
    height: 60%;
    overflow-x: hidden;
    overflow-y: auto;
    background-color: rgba(7, 137, 18, 0.798);
    z-index: 1;
}
button{
    margin-top: 20px;
    margin-left: 20px;
    border-radius: 10px;
    border: none;
    height: 40px;
    width: 80px;
}
.button{
    display: flex;
    justify-content: end;
    margin-top: 50px;
}

button:hover{
    background-color: aquamarine;
    transform: scale(1.1);
}
</style>