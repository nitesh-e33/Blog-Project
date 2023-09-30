<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
<title>Blog View</title>
<a href="/my-account" class="btn btn-primary">Go to DashBoard</a>
</head> -->
<body>

@include("header")

<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show">
      @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
      @endif
</div>
<center>
       <form id="form"  action="/blog-list" method="get">
            <div class="input-control">

            <label for="category">Category</label>
                <select name="category_id" id="category">
                  <option value="">Select User</option>
                    @foreach($category_data as $name)
                      <option value="{{ $name['category_id'] }}" @if(\Arr::get($inputs,'category_id','')==$name['category_id']) selected @endif>{{$name['category_name']}}</option>
                    @endforeach            
                </select>

                <label for="title">Title</label>
                <input id="title" name="title" type="text" placeholder="search title" value="{{\Arr::get($inputs,'title','')}}" />

            </div>
            <button type="submit" class="btn btn-primary">Search</button>
      </form>


<div>
        <div class="container">
        <table class="table" border="1">
            <thead>
                <tr>
                    <!-- <th width="150px">Id</th> -->
                    <th width="150px">Category</th>
                    <th width="150px">Title</th>
                    <th width="150px">Description</th>
                    <th width="150px">Image</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>  
            @if(!empty($bloglist))
              @foreach($bloglist as $blog)
                <tr height="70px">
                <td width="150px">
                      {{$blog['category_name']}}
                  </td>
                   <td width="150px">
                        {{$blog['title']}}
                    </td>
                    <td width="150px">
                        {{$blog['description']}}
                    </td>
                    <td width="200px">
                        <img src="{{ asset('uploads/customers/'.$blog['image']) }}" width="150px" height="150px" alt="image" title="job image">
                    </td>
                    <td width="150px">
                        <a href=" {{ url('/edit-blog/'.$blog['blog_id']) }} " class="btn btn-primary">Edit</a>
                        <button type="button" class="btn btn-danger" onclick="deleteBlog('{{$blog['blog_id']}}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            @else
               <tr>No Data Found</tr>
            @endif
            </tbody>
        </table>
    </div>
    </center>
</div>
</body>

<script type="text/javascript">
   
    function deleteBlog(blog_id){
        if(confirm("Do you want to delete this blog ?")){
            $.ajaxSetup({
              headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                url: " {{ route('deleteBlog') }} ",
                type: "post",
                dataType: 'json',
                data:{
                     blog_id: blog_id,
                },
                success : function(response){
                   toastr.success("Delete successfully");
                   window.location.reload();
                }
            });
        }else {
            return false;
        }
    }

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
       $(".alert").slideUp(500);
    });
</script>



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












