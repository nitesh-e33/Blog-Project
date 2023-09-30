<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <center>
<form onsubmit="return validateForm()">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>
  <span id="nameError" class="error"></span>
  
  <label for="mobile">Mobile No:</label><br>
  <input type="text" id="mobile" name="mobile"><br>
  <span id="mobileError" class="error"></span>
  
  <label for="email">Email:</label><br>
  <input type="email" id="email" name="email"><br>
  <span id="emailError" class="error"></span>
  
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <span id="passwordError" class="error"></span>
  
  <label for="confirmPassword">Confirm Password:</label><br>
  <input type="password" id="confirmPassword" name="confirmPassword"><br>
  <span id="confirmPasswordError" class="error"></span>
  
  <input type="submit" value="Submit">
</form>
</center>


    <script>
function validateForm() {
 
  const name = document.getElementById('name').value;
  const mobile = document.getElementById('mobile').value;
  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  

  document.getElementById('nameError').textContent = '';
  document.getElementById('mobileError').textContent = '';
  document.getElementById('emailError').textContent = '';
  document.getElementById('passwordError').textContent = '';
  document.getElementById('confirmPasswordError').textContent = '';

 
  let isValid = true;

  if (name.trim() === '') {
    document.getElementById('nameError').textContent = 'Name is required';
    isValid = false;
  }

  if (mobile.trim() === '') {
    document.getElementById('mobileError').textContent = 'Mobile number is required';
    isValid = false;
  } else if (!isValidMobile(mobile)) {
    document.getElementById('mobileError').textContent = 'Invalid mobile number';
    isValid = false;
  }

  if (email.trim() === '') {
    document.getElementById('emailError').textContent = 'Email is required';
    isValid = false;
  } else if (!isValidEmail(email)) {
    document.getElementById('emailError').textContent = 'Invalid email format';
    isValid = false;
  }

  if (password.trim() === '') {
    document.getElementById('passwordError').textContent = 'Password is required';
    isValid = false;
  }

  if (confirmPassword.trim() === '') {
    document.getElementById('confirmPasswordError').textContent = 'Confirm Password is required';
    isValid = false;
  } else if (password !== confirmPassword) {
    document.getElementById('confirmPasswordError').textContent = 'Passwords do not match';
    isValid = false;
  }



  if (!isValid) {
    alert('Please fill in all required fields correctly.');
    return false; // Prevent form submission
  }

 
  return true;
}

function isValidMobile(mobile) {
  const mobileRegex = /^\d{10}$/;
  return mobileRegex.test(mobile);
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}
</script>

</body>
</html>

<style>
    .error {
  color: red;
  font-size: 14px;
}

</style>