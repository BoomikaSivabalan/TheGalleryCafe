// Get the form element
const form = document.querySelector('form');

// Add an event listener to the form's submit event
form.addEventListener('submit', (e) => {
  e.preventDefault(); // Prevent the default form submission behavior

  // Get the form data
  const name = document.querySelector('#name').value;
  const email = document.querySelector('#email').value;
  const number = document.querySelector('#number').value;
  const message = document.querySelector('#message').value;

  // Client-side validation
  if (name === '' || email === '' || number === '' || message === '') {
    alert('Please fill in all fields');
    return;
  }

  // Get the form data
const formData = new FormData();
formData.append('name', document.getElementById('name').value);
formData.append('email', document.getElementById('email').value);
formData.append('number', document.getElementById('number').value);
formData.append('message', document.getElementById('message').value);

// Send the form data to the server using XMLHttpRequest
const xhr = new XMLHttpRequest();
xhr.open('POST', 'contact.php', true);
xhr.send(formData);

  // Handle the server response
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert('Form submitted successfully!');
      form.reset();
    } else {
      alert('Error submitting form');
    }
  };
});