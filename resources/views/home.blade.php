<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <script defer src="./index.js"></script>
</head>
<body>
   <form  id="form" action="/signup" method ="post">
    @csrf
    <div class="container">         
            <h1>Registration</h1>
            <div class="input-control">
                <label for="username">Name</label>
                <input id="username" name="username" type="text">
                <!-- <div class="error"></div> -->
                <span class="error"></span>
            </div>
            <div class="input-control">
                <label for="MobileNo">Mobile Number</label>
                <input id="mobileno" name="mobileno" type="text">
                <span class="error"></span>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text">
                <span class="error"></span>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password"name="password" type="password">
                <span class="error"></span>
            </div>
            <div class="input-control">
                <label for="password2">Confirm Password</label>
                <input id="password2"name="password2" type="password">
               <span class="error"></span>
            </div>
            <button type="submit" class="submit">Sign Up</button>   
    </div>

    </form>

    <script>
        //$('#username').val();
        const form = document.getElementById('form');
        const username = document.getElementById('username');
        const mobileno = document.getElementById('mobileno');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
    e.preventDefault();
    validateInputs();  
    var actionurl = e.currentTarget.action;  
    
    
});

    const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

    const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
  
function isValidNumber(input) {
  var pattern = /^[0-9]{10}$/;
  return pattern.test(input);
}

function isValidName(name) {
    var pattern = /^[A-Za-z\s]+$/;
    return pattern.test(name);

}


const validateInputs = () => {
    const usernameValue = username.value.trim();
    const emailValue = email.value.trim();
    const mobileValue = mobileno.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();

    if(usernameValue === '') {
        setError(username, 'Name is required');
    } else if(!isValidName(usernameValue)) {
        setError(username, 'Provide a valid name');
    } else {
        setSuccess(username);
    }

    if(mobileValue === '') {
        setError(mobileno, 'Mobile no is required');
    } else if(mobileValue.length != 10 || !isValidNumber(mobileValue)) {
        setError(mobileno, 'Invalid Number');
    } else {
        setSuccess(mobileno);
    }

    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }

    // if(passwordValue === '') {
    //     setError(password, 'Password is required');
    // } else if (passwordValue.length < 8 ) {
    //     setError(password, 'Password must be at least 8 character.')
    // } else {
    //     setSuccess(password);
    // }

    // if(password2Value === '') {
    //     setError(password2, 'Please confirm your password');
    // } else if (password2Value !== passwordValue) {
    //     setError(password2, "Passwords doesn't match");
    // } else {
    //     setSuccess(password2);
    // }
    $('#form').submit();


};

    </script>
</body>

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

#form {
    width: 300px;
    margin: 20vh auto 0 auto;
    padding: 20px;
    background-color: whitesmoke;
    border-radius: 4px;
    font-size: 12px;
}

#form h1 {
    color: #0f2027;
    text-align: center;
}

#form button {
    padding: 10px;
    margin-top: 10px;
    width: 100%;
    color: white;
    background-color: rgb(41, 57, 194);
    border: none;
    border-radius: 4px;
}

.input-control {
    display: flex;
    flex-direction: column;
}

.input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 12px;
	padding: 10px;
	width: 100%;
}

.input-control input:focus {
    outline: 0;
}

.input-control.success input {
    border-color: #09c372;
}

.input-control.error input {
    border-color: #ff3860;
}

.input-control .error {
    color: #ff3860;
    font-size: 9px;
    height: 13px;
}
</style>
</html>






<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Name  </th>
                    <th>Mobile No  </th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td scope="row"></td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->mobileno}}</td>
                    <td>{{$customer->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html> -->