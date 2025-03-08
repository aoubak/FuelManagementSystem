document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission
  
    let isValid = true;
  
    // Name validation
    const name = document.getElementById("name").value;
    if (name === "") {
      document.getElementById("nameError").textContent = "Name is required";
      isValid = false;
    } else {
      document.getElementById("nameError").textContent = "";
    }
  
    // Email validation
    const email = document.getElementById("email").value;
    if (email === "") {
      document.getElementById("emailError").textContent = "Email is required";
      isValid = false;
    } else if (!isValidEmail(email)) {
      document.getElementById("emailError").textContent = "Invalid email format";
      isValid = false;
    } else {
      document.getElementById("emailError").textContent = "";
    }
  
    // If all fields are valid, submit the form using AJAX
    if (isValid) {
      submitForm();
    }
  });
  
  function isValidEmail(email) {
    // Basic email format validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
  
  function submitForm() {
    const form = document.getElementById("myForm");
    const formData = new FormData(form);
  
    fetch(form.action, {
      method: form.method,
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      // Handle the response from the server (e.g., display a success message)
      alert(data); 
      form.reset(); // Clear the form
    })
    .catch(error => {
      console.error("Error submitting form:", error);
      // Handle errors (e.g., display an error message)
    });
  }