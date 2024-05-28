<template>
  <div>
    <!-- Add User Button and User Table here -->
    <div class="my-5">
      <div class="form-row">
        <div class="form-group col-md-12 col-sm-12 text-end">
          <button class="btn btn-success btn-sm fw-bold" @click="toggleAddUser()"
                  style="height: 50px; width: 150px; padding: 20px; border-radius: 15px; margin-right: 50px;">
            Add User
          </button>
        </div>
      </div>

      <AddUser
        :isAddUserVisible="isAddUserVisible" 
        @close="closeUser" 
        @submit="addUsers"
      />

      <EditUser 
        :isEditUserVisible="isEditUserVisible"
        :formData="editUserData"
        @close="closeEdit"
        @update="updateUser"
      />
      
      <DeleteUser
        :isDeleteVisible="isDeleteVisible"
       :eventId="parseInt(selectedUserId, 10)" 
        :eventTitle="selectedUserName"
        @close="closeDelete"
        @delete="deleteUser"
      />

      <!-- User Table -->
      <div class="form-row mt-4">
        <div class="col-md">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.contact }}</td>
                  <td>{{ user.password }}</td>
                  <td>
                    <button class="btn btn-danger btn-sm" @click="toggleDelete(user)">Delete</button>
                    <button class="btn btn-info btn-sm" @click="toggleEditUser(user)">Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AddUser from '../Users/AddUser.vue';
import EditUser from '../Users/EditUser.vue';
import DeleteUser from '../Users/DeleteConfirmation.vue';

export default {
  name: "UserList",
  components: {
    AddUser,
    DeleteUser,
    EditUser,
  },
  setup() {
    const isAddUserVisible = ref(false);
    const isEditUserVisible = ref(false);
    const isDeleteVisible = ref(false);
    const users = ref([]);
    const selectedUserId = ref(0);
    const selectedUserName = ref(''); // Define selectedUserName
    const editUserData = ref({});

    const toggleAddUser = () => {
      isAddUserVisible.value = !isAddUserVisible.value;
    };

    const toggleEditUser = (user) => {
      selectedUserId.value = user.id;
      editUserData.value = { ...user }; // Clone the user data to avoid direct mutation
      isEditUserVisible.value = true;
    };

    const toggleDelete = (user) => {
      selectedUserId.value = parseInt(user.id, 10) || 0; // Use 0 as a default value if user.id is not available
      selectedUserName.value = user.name || ''; // Use empty string as default if user.name is not available
      isDeleteVisible.value = !isDeleteVisible.value;
    };

    const closeUser = () => {
      isAddUserVisible.value = false;
    };

    const closeEdit = () => {
      isEditUserVisible.value = false;
    };

    const closeDelete = () => {
      isDeleteVisible.value = false;
    };

    const addUsers = async (userData) => {
      try {
        const data = new FormData();
        data.append("name", userData.name);
        data.append("email", userData.email);
        data.append("contact", userData.contact);
        data.append("password", userData.password);
        const res = await axios.post('http://localhost/resort_fullstack/src/Api/api.php?action=addusers', data);
        if (res.data.error) {
          console.error("Error:", res.data.message);
        } else {
          closeUser();
          fetchUsers();
        }
      } catch (err) {
        console.error(err);
      }
};

    const fetchUsers = async () => {
      try {
        const response = await axios.get('http://localhost/resort_fullstack/src/Api/api.php?action=getuserinfo');
        users.value = response.data.user_Data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    };

    const deleteUser = async (userId) => {
      try {
        if (!userId) {
          console.error("User ID is null or undefined!");
          return;
        }
        const response = await axios.get(`http://localhost/resort_fullstack/src/Api/api.php?action=deleteUser&id=${userId}`);
        if (!response.data.error) {
          fetchUsers();
        } else {
          console.error('Error deleting user:', response.data.message);
        }
      } catch (error) {
        console.error('Error deleting user:', error);
      }
    };

    const updateUser = async (userData) => {
      try {
        const response = await axios.post('http://localhost/resort_fullstack/src/Api/api.php?action=updateUser', userData);
        if (!response.data.error) {
          console.log("Update successful:", response.data.message);
          fetchUsers(); // Refresh the user list
          closeEdit();
        } else {
          console.error('Error updating user:', response.data.message);
        }
      } catch (error) {
        console.error('Error updating user:', error);
      }
    };

    onMounted(fetchUsers);

    return {
      users,
      selectedUserId,
      selectedUserName, // Include selectedUserName in return statement
      isAddUserVisible,
      isEditUserVisible,
      isDeleteVisible,
      editUserData,
      toggleAddUser,
      toggleEditUser,
      toggleDelete,
      closeUser,
      closeEdit,
      closeDelete,
      addUsers,
      fetchUsers,
      deleteUser,
      updateUser
    };
  },
};
</script>
