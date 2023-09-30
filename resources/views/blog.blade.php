<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Create</title>
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="./style.css"> -->
</head>
<body>
<form  id="form" enctype="multipart/form-data" action="/postBlog" method ="post">
    @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('failed'))
        <div class="alert alert-info">{{Session::get('failed')}}</div>
    @endif
@csrf
        <div class="container">
            <h1>Blog</h1>
            <div class="input-control">
                <label for="title">Category</label>
                <select name="category" id="category">
                    @foreach($category_data as $name)
                      <option value="{{ $name->category_id }}">{{$name->category_name}}</option>
                    @endforeach
                  
                </select>
            </div>
            <div class="input-control">
                <label for="title">Title</label>
                <input id="title" name="title" type="text" />
                <!-- <div class="error"></div> -->
                <span class="error">
                    @error('title')
                    {{$message}}
                    @enderror
                </span>
            </div>
            <div class="input-control">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5" cols="50"></textarea>
                <!-- <input id="description" name="description" type="textarea" /> -->
                <!-- <div class="error"></div> -->
                <span class="error">
                    @error('description')
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
            <button type="submit" class="submit">Create Blog</button>
        </div>

        @if(Session::get('role') == 'admin')
           <a href="/admin/myaccount">Go to Back</a>
        @else
           <a href="/my-account">Go to back</a>
        @endif
</form>
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

    .input-control select {
        border: 2px solid #f0f0f0;
        border-radius: 4px;
        display: block;
        font-size: 12px;
        padding: 10px;
        width: 100%;
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
    <div class="contain">
        <div class="text">
            <form id="form" action="/postBlog" method="post">
                @csrf
                <h1>Blog</h1>
                <input class="cls" name= "title" type="title" placeholder="title"><br>
                <input class="cls" name= "description" type="textarea" placeholder="description">
                <button type="submit" id="bt">Create Blog</button>
            </form>
        </div>
    </div>
</body>
</html>
<style>
    * {
        margin: 0%;
        padding: 0%;
    }
    body {
        background-color: black;
        background-size: 100% 740px;
    }
    .contain {
        padding-top: 200px;
        padding-left: 40%;
        width: 300px;
        height: 400px;
        text-align: center;
        color: white;
    }
    .contain.text {
        position: relative;
        top: 7%;
    }
    .cls {
        outline: none;
        border: none;
        background-color: black;
        border-bottom: 2px solid white;
        width: 250px;
        font-size: 20px;
        margin-top: 40px;
        color: white;
        height: 40px;
        padding-left: 10px;
    }
    #bt {
        width: 250px;
        height: 44px;
        background-color: aqua;
        color: black;
        border: none;
        font-size: 22px;
        border-radius: 25px;
        margin-top: 20px;
    }
    #bt:hover {
        border: 3px solid aqua;
        color: white;
        font-size: 20px;
        background-color: black;
        cursor: pointer;
    }
</style> -->