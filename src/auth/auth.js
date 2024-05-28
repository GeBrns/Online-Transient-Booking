// Function to check if the user is authenticated
export function getCurrentUser() {
    // Assuming you have a token stored in localStorage
    const authToken = localStorage.getItem('authToken');
    // Return true if authToken exists, indicating the user is authenticated
    return authToken !== null;
  }