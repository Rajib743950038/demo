 // Grid Numbers code Start 
  // Get all the input elements
  const inputElements = document.querySelectorAll('.box input[type="text"]');

  // Attach event listeners to each input element
  inputElements.forEach(input => {
    input.addEventListener('input', restrictToTwoDigits);
  });

  // Function to restrict input to two digits
  function restrictToTwoDigits(event) {
    const inputValue = event.target.value;
    // Remove any non-digit characters
    const digitValue = inputValue.replace(/\D/g, '');
    // Limit the value to two digits
    const limitedValue = digitValue.slice(0, 2);
    // Update the input value
    event.target.value = limitedValue;
  }
// Grid Numbers code End


// Loding screen
  // Show the loading container
  document.getElementById("loadingContainer").style.display = "block";

  // Hide the loading container after 3 seconds
  setTimeout(function() {
    document.getElementById("loadingContainer").style.display = "none";
  }, 3000);