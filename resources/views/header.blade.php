<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
  <!-- <center><h1>Log in Successfully</h1></center> -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
  <title>Dashboard</title>
</head>

<body>

<div class="dashboard">
    <div class="dashboard-header">
    @if(Session::get('role') == 'admin')
      <a href="/admin/myaccount" style="text-decoration:none">
         <h1>Welcome to Your Dashboard</h1>
      </a>
    @else 
       <a href="/my-account" style="text-decoration:none">
         <h1>Welcome to Your Dashboard</h1>
        </a>
    @endif

      <div>
        @if(Session::get('role') == 'admin')
           <a href="/admin/category-list" class="btn btn-info">Category</a>
        @else
           <a href="/user/category-list" class="btn btn-info">Category</a>
        @endif
        <a href="/category" class="btn btn-info">Create Category</a>
        @if(Session::get('role') == 'admin')
          <a href="/admin/blog-list" class="btn btn-info">Blog</a>
        @else
          <a href="/blog-list" class="btn btn-info">Blog</a>
        @endif
        <a href="/blog" class="btn btn-info">Create Blog</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div> 

</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</html>


<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }

  .dashboard {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  .dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .dashboard-header h1 {
    margin: 0;
    font-size: 24px;
  }

  .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: #fff;
  }

  .btn-danger {
    background-color: #dc3545;
    color: #fff;
  }
</style>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="dashboard">
    <div class="dashboard-header">
      <a href="/admin/myaccount" style="text-decoration:none">
        <h1>Welcome to Your Dashboard</h1>
      </a>
      <div>
        <a href="/admin/category-list" class="btn btn-info">Category</a>
        <a href="/category" class="btn btn-info">Create Category</a>
        <a href="/admin/blog-list" class="btn btn-info">Blog</a>
        <a href="/blog" class="btn btn-info">Create Blog</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </div> 


</body>
</html>




  <style>
    .dashboard {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
  }

  .dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .dashboard-header h1 {
    margin: 0;
    font-size: 24px;
  }
  </style> -->