// Get the "Ban user" button element
const banButton = document.querySelector('#ban-button');

// Add a click event listener to the button
banButton.addEventListener('click', () => {
  // Get the user ID from the button data attribute
  const userId = banButton.dataset.userId;
  
  // Send a POST request to the ban user endpoint with the user ID as data
  fetch(`/users/${userId}/ban`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ userId: userId })
  })
  .then(response => {
    if (response.status === 200) {
      // Display a success message
      alert('User has been banned');
    } else {
      // Display an error message
      alert('Error banning user');
    }
  })
  .catch(error => {
    // Display an error message
    alert('Error banning user');
  });
});