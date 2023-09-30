<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>

    <title>Login Form</title>
</head>
<body>
    
    <form  id="form" action="/signin" method ="post">
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
      @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
      @if(Session::has('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
      @endif
    </div>
    
    @csrf
       <div class="container">         
            <h1>Login</h1>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text"/>
                <span class="error">
                    <!-- @error('email')
                        {{$message}}
                    @enderror -->
                   
                </span>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password"name="password" type="password">
                <span class="error">
                    <!-- @error('password')
                        {{$message}}
                    @enderror -->
                </span>
            </div>

            <button type="submit" class="submit">Log in</button>     
            <br><br>
            <a href="signup">New User !! Register Here</a>   
        </form>
    </div>

    <script>
        //  if(Session::has('failed')) 
        //      toastr.error("{{ session('failed') }}")
        // endif
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
          $(".alert").slideUp(500);
        });
    </script>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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






<!-- <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="/signin" method="post">
        @csrf
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <span class="error">
                    @error('email')
                       {{$message}}
                    @enderror
                </span> -->

                  <!-- <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error">
                    @error('password')
                       {{$message}}
                    @enderror
                </span> -->

                 <!-- <input type="submit" value="Login"> -->


<!-- body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        #form {
            display: flex;
            flex-direction: column;
        }

        #form label {
            margin-bottom: 5px;
        }

        #form input[type="text"],
        #form input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        #form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        #form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .input-control .error {
               color: #ff3860;
               font-size: 9px;
               height: 13px;
        }  -->