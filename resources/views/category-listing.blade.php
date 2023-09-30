<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<title>Search Category</title>
</head>
<body>

@if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif
<!-- <a href="/admin/myaccount" class="btn btn-primary">Go to DashBoard</a> -->
@include("header")

<div>
    <form id="form" enctype="multipart/form-data" action="/admin/category-list" method="get">
    <!-- @csrf -->
        <center>

            <div class="input-control">
                <label for="category">Category</label>
                <input id="category" name="category_name" type="text" placeholder="search category" value="{{\Arr::get($inputs,'category_name','')}}" />

                <label for="title">Name</label>
                <select name="customer_id" id="name">
                @if(!empty($userlist))
                    <option value="">Select User</option>
                    @foreach($userlist as $name)                      
                      <option value="{{ $name['customer_id'] }}" @if(\Arr::get($inputs,'customer_id','')==$name['customer_id']) selected @endif>{{$name['name']}}</option>
                    @endforeach                  
                @endif
                </select>
            </div>
            <button type="submit" class="submit">Search</button>

        </center>
    </form>
</div>

    <div class="container">
    <table class="table" border="1">
            <thead>
                <tr>
                    <th width="50px">Name</th>
                    <th width="70px">Category Name</th>                
                    <th width="70px">Status</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody> 
            @if(!empty($catlist))
               @foreach($catlist as $data)
                <tr height="70px">
                <td width="50px">
                  {{$data['customer_name']}}
                </td>
                <td width="70px">
                   {{$data['category_name']}}
                </td>
                <td width="70px">
                   {{$data['status']}}
                </td>
                <td width="150px">
                      <a href=" {{ url('/edit-category/'.$data['category_id']) }} " class="btn btn-primary">Edit</a>
                      @if($data['status'] == 'active')
                                <button type="button" class="btn btn-primary" onclick="changeStatus('{{$data['category_id']}}','disable')">Inactive</button>
                      @else
                                <button type="button" class="btn btn-primary" onclick="changeStatus('{{$data['category_id']}}','active')">Active</button>
                      @endIf                
                </td>
                </tr>
                @endforeach
            @else
               <tr>No Data Found</tr>
            @endif
            </tbody>
        </table>
    </div>
</body>

<script type="text/javascript">
    function changeStatus(category_id,category_status){
        // alert(category_status);
        if(confirm("Do you want to change status of this category ?")){
            $.ajaxSetup({
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                url: " {{ route('changeCategoryStatus') }} ",
                type: "post",
                dataType: 'json',
                data:{
                    category_id: category_id,
                    category_status: category_status,
                },
                success : function(response){
                   toastr.success("Status update successfully");
                   window.location.reload();
                }
            });
        }else {
            return false;
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</html>

<style>
#form button {
  padding: 10px;
  margin-top: 10px;
  width: auto;
  color: white;
  background-color: rgb(41, 57, 194);
  border: none;
  border-radius: 4px;
}

.input-control #name {
  width: 150px;
}

.category-link{
  display: flex;   
}
.w-5{
    display: none;
}

</style>























<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<title>Blog View</title>
<a href="/my-account" class="btn btn-primary">Go to DashBoard</a>
</head>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

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
 -->
