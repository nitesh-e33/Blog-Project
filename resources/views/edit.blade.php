<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <title>Edit Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
      @if(Session::has('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
      @endif
</div>
    <div class="container"> 
        <h1>Edit Profile</h1>
        <form id="editForm" enctype="multipart/form-data" action="{{ url('profile-edit/'.$customer->customer_id) }}" method ="post">
            @csrf
 
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $customer->name}}">
            
            <label for="mobile">Mobile No.:</label>
            <input type="tel" id="mobile" name="mobile" value="{{ $customer->mobileno}}">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $customer->email}}">

            <label for="image">Profile Image:</label>
            <img src="{{ asset('uploads/customers/'.$customer->image) }}" width="170px" height="150px" alt="image" title="job image">
            <input type="file" id="image" name="image" accept="image/*">
            
            <button type="submit">Save</button>

            <a href="/my-account">Go to Back</a>
        </form>
    </div>
    <script>
      $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
      });
    </script>
</body>
</html>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

form {
    display: grid;
    gap: 15px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="tel"],
input[type="email"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
