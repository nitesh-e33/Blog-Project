<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container"> 
        <h1>Edit Category</h1>
        <form id="editForm" enctype="multipart/form-data" action="{{ url('post-edit-category/'.$category->category_id) }}" method ="post">
            @csrf

            @if(Session::has('failed')) 
               <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif
            
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="{{ $category->category_name}}">
            
            <button type="submit">Save</button>

            @if(Session::get('role') == 'admin')
               <a href="/admin/category-list">Go to Back</a>
            @else
               <a href="/user/category-list">Go to Back</a>
            @endif
        </form>
    </div>
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
