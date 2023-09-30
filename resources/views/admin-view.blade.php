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

  <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('message'))
    <div class="alert alert-info">{{Session::get('message')}}</div>
    @endif
  </div>

  @include("header")
  <!-- <div class="dashboard">
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
  </div> -->

  <div>
    <center>
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name </th>
              <th>Mobile No </th>
              <th>Email</th>
              <th>Image</th>
              <th>Role</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userdata as $user)
            <tr height="70px">
              <td width="150px">
                <center>{{$user->customer_id}}</center>
              </td>
              <td width="150px">
                <center>{{$user->name}}</center>
              </td>
              <td width="150px">
                <center>{{$user->mobileno}}</center>
              </td>
              <td width="150px">
                <center>{{$user->email}}</center>
              </td>
              <td width="200px">
                <img src="{{ asset('uploads/customers/'.$user->image) }}" width="70px" height="70px" alt="image" title="job image">
              </td>
              <td width="150px">
                <center>{{$user->role}}</center>
              </td>
              <td width="150px">
                <center>{{$user->status}}</center>
              </td>

              <td width="800px">
                <center>
                  @if($user->status == 'active')
                  <button type="button" class="btn btn-primary" onclick="changeStatus('{{$user->customer_id}}','disable')">Inactive</button>
                  @else
                  <button type="button" class="btn btn-primary" onclick="changeStatus('{{$user->customer_id}}','active')">Active</button>
                  @endIf
                </center>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </center>
  </div>
</body>

<script type="text/javascript">
  function changeStatus(customer_id, user_status) {
    if (confirm("Do you want to change status of this user ?")) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: " {{ route('updateStatus') }} ",
        type: "post",
        dataType: 'json',
        data: {
          user_id: customer_id,
          user_status: user_status,
        },
        success: function(response) {
          toastr.success("Status update successfully");
          window.location.reload();
        }
      });
    } else {
      return false;
    }
  }

  $(".alert").fadeTo(2000, 500).slideUp(500, function() {
    $(".alert").slideUp(500);
  });
</script>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->

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