<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
    <div class="container">
        <h1>Sign Up</h1>
        <form id="signup-form">
      <label for="name">Name</label>
            <input type="text" id="name">

            <label for="mobile">Mobile Number</label>
            <input type="tel" id="mobile">

            <label for="email">Email</label>
            <input type="email" id="email">

            <label for="password">Password</label>
            <input type="password" id="password">

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password">

            <button type="submit">Sign Up</button>
        </form>
    </div>
    <!-- <script src="script.js"></script> -->

    <script>
    const form = document.getElementById("signup-form");

    form.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("name").value;
    const mobile = document.getElementById("mobile").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // Add your validation logic here
    // You can check if the fields are not empty and if passwords match, etc.

    // console.log("Name:", name);
    // console.log("Mobile Number:", mobile);
    // console.log("Email:", email);
    // console.log("Password:", password);
    // console.log("Confirm Password:", confirmPassword);
});

const usernameValue = name.value.trim();
    const emailValue = email.value.trim();
    const mobileValue = mobileno.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();

    if(usernameValue === '') {
        alert('Username is required');
    } else {
        alert(name);
    }

    if(mobileValue === '') {
       alert('Mobile no is required');
    } else if(mobileValue.length != 10  && !isValidNumber(mobileValue)) {
        alert(mobileno, 'Invalid Number');
    } else {
        alert(mobileno);
    }

    if(emailValue === '') {
        alert(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        alert(email);
    }

    if(passwordValue === '') {
       alert(password, 'Password is required');
    } else if (passwordValue.length < 8 ) {
       alert(password, 'Password must be at least 8 character.')
    } else {
        alert(password);
    }

    if(password2Value === '') {
       alert(password2, 'Please confirm your password');
    } else if (password2Value !== passwordValue) {
       alert(password2, "Passwords doesn't match");
    } else {
        alert(password2);
    }

</script>
</body>
</html>


<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f0f0f0;
}

.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>


