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
    <div class="container"> 
        <h1>Edit Blog</h1>
        <form id="editForm" enctype="multipart/form-data" action="{{ url('blog-edit/'.$blog->blog_id) }}" method ="post">
            @csrf

            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
               @if(Session::has('failed')) 
                 <div class="alert alert-danger">{{Session::get('failed')}}</div>
               @endif
            </div>
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $blog->title}}">
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" value="{{ $blog->description}}">

            <label for="image">Blog Image:</label>
            <img src="{{ asset('uploads/customers/'.$blog->image) }}" width="170px" height="150px" alt="image" title="job image">
            <input type="file" id="image" name="image" accept="image/*">
            
            <button type="submit">Save</button>

            <a href="/blog-list">Go to Back</a>

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
