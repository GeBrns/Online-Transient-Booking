<script>
import axios from 'axios';
import { mapActions } from 'vuex';

export default {
  name: "LoginView",
  data() {
    return {
      Admin: {
        email: null,
        password: null
      },
      serverError: null
    };
  },
  methods: {
    ...mapActions(['login']),
    onLogin() {
      const data = new FormData();
      data.append('email', this.Admin.email);
      data.append('password', this.Admin.password);

      axios.post("http://localhost/resort_fullstack/src/Api/api.php?action=Login", data)
        .then((res) => {
          console.log("Response from server:", res.data);
          if (res.data.error) {
            this.serverError = res.data.message;
          } else {
            console.log("Success", res.data.message);
            console.log("Redirecting...");

            // Store the authentication token in Vuex store
            this.login(res.data.authToken);

            // Redirect to the dashboard
            this.$router.push('/dashboard/appointment');
          }
        })
        .catch((err) => {
          console.log("Error", err);
          this.serverError = 'An error occurred. Please try again later.';
        });
    }
  }
};
</script>

<template>
  <div class="form-center">
    <form @submit.prevent="onLogin">
      <h3 class="login-heading mb-4">Welcome!</h3>
      <div class="form-floating mb-3">
        <input 
          id="user" 
          name="email" 
          type="email" 
          class="form-control" 
          placeholder="Email" 
          v-model="Admin.email"
          autocomplete="email">
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating mb-3">
        <input  
          name="password" 
          type="password" 
          class="form-control" 
          placeholder="Password" 
          v-model="Admin.password"
          autocomplete="password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="d-grid">
        <button class="btn btn-lg btn-success btn-login text-uppercase fw-bold mb-2" type="submit">Login</button>
      </div>
      <div v-if="serverError" class="error">{{ serverError }}</div>
    </form>
  </div>
</template>

<style scoped>
.form-center {
  display: flex;
  justify-content: center;
  margin-top: 10%;
}

form {
  width: 30rem;
}

.btn{
  width: 100%;
}

.error {
  color: red;
  font-size: 0.9em;
}
</style>
