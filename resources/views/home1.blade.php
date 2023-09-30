<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <script defer src="./index.js"></script>
</head>

<body>
    <form id="form" enctype="multipart/form-data" action="/signup" method="post">
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif

        @csrf
        <div class="container">
            <h1>Registration</h1>
            <div class="input-control">
                <label for="username">Name</label>
                <input id="username" name="name" type="text" value="{{old('name')}}" />
                <!-- <div class="error"></div> -->
                <span class="error">
                    @error('name')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="input-control">
                <label for="MobileNo">Mobile Number</label>
                <input id="mobileno" name="mobileno" type="text" value="{{old('mobileno')}}" />
                <span class="error">
                    @error('mobileno')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" value="{{old('email')}}" />
                <span class="error">
                    @error('email')
                    {{$message}}
                    @enderror
                </span>
            </div>

            <div class="input-control">
                <label for="image">Profile Image:</label>
                <input type="file" id="image" name="image" accept="image/">
                <span class="error">
                    @error('image')
                    {{$message}}
                    @enderror
                </span>
            </div>

            <div class="input-control">
                <label for="password">Password</label>
                <input id="password" name="password" type="password">
                <span class="error">
                    @error('password')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="input-control">
                <label for="password2">Confirm Password</label>
                <input id="password2" name="confirm_password" type="password">
                <span class="error">
                    @error('confirm_password')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <button type="submit" class="submit">Sign Up</button>
            <br><br>
            <a href="signin">Already Registered!! Login here</a>
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

        //    'name' => 'required|alpha',
        //     'mobileno' => 'required|numeric|digits:10',
        //     'email' => 'required|email|unique:customers',
        //     'password' => 'required',
        //     'confirm_password' => 'required|same:password'

        //    form.addEventListener('submit', e => {
        //        validateInputs();  
        //        // var actionurl = e.currentTarget.action;  
        //        if(isFormValid() == true) {
        //            form.submit();
        //         } else {
        //             e.preventDefault();
        //     }
        //     });

        function isFormValid() {
            const inputContainers = form.querySelectorAll('.input-control');
            let result = true;
            inputContainers.forEach((container) => {
                if (container.classList.contains('error')) {
                    result = false;
                }
            });
            return result;
        }

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


        function validateInputs() {
            const usernameValue = username.value.trim();
            const emailValue = email.value.trim();
            const mobileValue = mobileno.value.trim();
            const passwordValue = password.value.trim();
            const password2Value = password2.value.trim();

            if (usernameValue === '') {
                setError(username, 'Name is required');
            } else if (!isValidName(usernameValue)) {
                setError(username, 'Provide a valid name');
            } else {
                setSuccess(username);
            }

            if (mobileValue === '') {
                setError(mobileno, 'Mobile no is required');
            } else if (mobileValue.length != 10 || !isValidNumber(mobileValue)) {
                setError(mobileno, 'Invalid Number');
            } else {
                setSuccess(mobileno);
            }

            if (emailValue === '') {
                setError(email, 'Email is required');
            } else if (!isValidEmail(emailValue)) {
                setError(email, 'Provide a valid email address');
            } else {
                setSuccess(email);
            }

            if (passwordValue === '') {
                setError(password, 'Password is required');
            } else if (passwordValue.length < 8) {
                setError(password, 'Password must be at least 8 character.')
            } else {
                setSuccess(password);
            }

            if (password2Value === '') {
                setError(password2, 'Please confirm your password');
            } else if (password2Value !== passwordValue) {
                setError(password2, "Passwords doesn't match");
            } else {
                setSuccess(password2);
            }


            // $('#form').submit();


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