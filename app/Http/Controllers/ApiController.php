<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Arr;
use App\Models\Customer;
use App\Models\Blog;
use App\Models\Category;
use Exception;
use DB;

class ApiController extends Controller
{
    public function postRegister(Request $request)
    {
        $input = $request->all();
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|alpha',
                'mobileno' => 'required|numeric|digits:10',
                'email' => 'required|email|unique:customers',
                'image' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid Details'
                ], 400);
            } else {
                $customer = new Customer;
                $customer->name = $input['name'];
                $customer->mobileno = $input['mobileno'];
                $customer->image = $input['image'];
                $customer->email = $input['email'];
                $customer->password = md5($input['password']);
                $customer->role = "user";
                $customer->status = "Inactive";
                $customer->save();
                return response()->json([
                    'status' => 200,
                    'code' => 'success'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function postLogin(Request $request)
    {
        $input = $request->all();
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid Details'
                ], 400);
            } else {
                $filled_email = Arr::get($request, 'email');
                $filled_pass = md5(Arr::get($request, 'password'));
                $user = Customer::where('email', '=', $filled_email, '')->first();
                $email = $user->email;
                $password = $user->password;
                if ($filled_email == $email && $filled_pass == $password && ($user->status == 'active' || $user->status == 1)) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                        'data' => $user
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 400,
                        'code' => 'failed',
                    ], 400);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function editProfilePage(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $customer = Customer::where('customer_id', $input)->first();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $customer
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function editProfile(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $customers = Customer::where('customer_id', $input['id'])->update([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'mobileno' => $input['mobile'],
                ]);
                if(!empty($image)){
                    $customers = Customer::where('customer_id', $input['id'])->update([
                        'image' => $input['image'],
                    ]); 
                }
                if ($customers == 1) {
                    $user = Customer::where('customer_id', $input['id'])->first();
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                        'data' => $user
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 400,
                        'code' => 'failed',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function createBlog(Request $request)
    {
        $input = $request->all();
        \Log::info($input);
        try {
            $validator = Validator::make($request->all(), [
                'category' => 'required',
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid Details'
                ], 400);
            } else {
                $count = Blog::where('slug', $input['slug'])->count();
                if ($count > 0) {
                    $input['slug'] .= '-' . ($count + 1);
                }
                $blog = new Blog;
                $blog->title = $input['title'];
                $blog->slug = $input['slug'];
                $blog->description = $input['description'];
                $blog->image = $input['image'];
                $blog->customer_id = $input['customer_id'];
                $blog->category_id = $input['category'];
                // $blog->save();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function editBlogPage(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $blog = Blog::where('blog_id', $input)->first();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $blog
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function editBlog(Request $request)
    {
        $input = $request->all();
        $image = \Arr::get($input,'image','');
        \Log::info($image);
        try {
            if (!empty($input)) {
                $blog = Blog::where('blog_id', $input['id'])->update([
                    'title' => $input['title'],
                    'description' => $input['description']
                ]);
                if(!empty($image)){
                    $blog = Blog::where('blog_id', $input['id'])->update([
                        'image' => $input['image'],
                    ]); 
                }
                if ($blog == 1) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 400,
                        'code' => 'failed',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function deleteBlog(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $response = Blog::where('blog_id', $input['blog_id'])->delete();
                if ($response == 1)
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                else {
                    return response()->json([
                        'status' => 400,
                        'code' => 'failed',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function updateUserStatus(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $user_id = $input['user_id'];
                $status = $input['user_status'];
                $data = Customer::where('customer_id', $user_id)->update(['status' => $status]);
                if ($data == 1) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                } else {
                    return false;
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    // public function getBlogData(Request $request)
    // {
    //     $input = $request->all();
    //     \Log::info($input);
    //     try {
    //         if (!empty($input)) {
    //             $query = DB::table('blog as b')
    //                 ->join('customers as c', 'b.customer_id', '=', 'c.customer_id')
    //                 ->join('category as ct', 'b.category_id', '=', 'ct.category_id')
    //                 ->where('b.customer_id', $input['customer_id'])
    //                 ->select('b.category_id as category','b.blog_id as blog_id', 'b.title as 
    //                 title', 'b.description as description', 'c.name as name','b.image as image','ct.category_name as category_name')
    //                 ->get();
    //             return response()->json([
    //                 'status' => 200,
    //                 'code' => 'success',
    //                 'data' => $query
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'status' => 404,
    //                 'message' => 'Input Not Found'
    //             ], 404);
    //         }
    //     } catch (Exception $e) {
    //         \Log::info($e);
    //         return response()->json([
    //             'status' => 400,
    //             'code' => 'failed'
    //         ], 400);
    //     }
    // }

    public function getAllBlogData(Request $request)
    {
        $inputs = $request->all();
        $category_id = \Arr::get($inputs, 'category_id', '');
        $title = \Arr::get($inputs, 'title', '');
        $customer_id = \Arr::get($inputs, 'customer_id', '');
        $role = \Arr::get($inputs, 'role', '');
        try {
            $query = DB::table('blog as b')
                ->join('customers as c', 'b.customer_id', '=', 'c.customer_id')
                ->join('category as ct', 'b.category_id', '=', 'ct.category_id');
            if (!empty($inputs)) {
                if($role == 'user'){
                    $query->where('b.customer_id', $customer_id);
                }
                if (!empty($category_id) && !empty($title) && !empty($customer_id)) {
                    $query->where('ct.category_id', $category_id);
                    $query->where('b.title', 'like', "%$title%");
                    $query->where('b.customer_id', $customer_id);
                } elseif (!empty($category_id) && !empty($title)) {
                    $query->where('ct.category_id', $category_id);
                    $query->where('b.title', 'like', "%$title%");
                } elseif (!empty($category_id) && !empty($customer_id)) {
                    $query->where('ct.category_id', $category_id);
                    $query->where('b.customer_id', $customer_id);
                } elseif (!empty($title) && !empty($customer_id)) {
                    $query->where('b.title', 'like', "%$title%");
                    $query->where('b.customer_id', $customer_id);
                } elseif (!empty($customer_id)) {
                    $query->where('b.customer_id', $customer_id);
                } elseif (!empty($category_id)) {
                    $query->where('ct.category_id', $category_id);
                } elseif (!empty($title)) {
                    $query->where('b.title', 'like', "%$title%");
                }
                // if ($role == 'admin') {
                   
                // } else {
                //     $query->where('b.customer_id', $customer_id);
                // }
            }
            $query->where('ct.status', 'active');
            $query = $query->select('b.slug as slug', 'b.blog_id as blog_id', 'ct.category_id as category_id', 'ct.category_name as category_name', 'b.title as title', 'b.description as description', 'c.name as name', 'b.image as image','b.status as b_status', 'b.created_at as created_at', 'ct.status as c_status')
                ->get();
            return response()->json([
                'status' => 200,
                'code' => 'success',
                'data' => $query
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    // public function getAllBlogData()
    // {
    //     try {
    //         $query = DB::table('blog')
    //             ->join('customers as c', 'blog.customer_id', '=', 'c.customer_id')
    //             ->join('category as ct', 'blog.category_id', '=', 'ct.category_id')
    //             ->select('blog.slug as slug', 'ct.category_id as category_id', 'ct.category_name as category_name', 'blog.title as title', 'blog.description as description', 'c.name as name', 'blog.image as image', 'blog.created_at as created_at')
    //             ->get();
    //         return response()->json([
    //             'status' => 200,
    //             'code' => 'success',
    //             'data' => $query
    //         ], 200);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 400,
    //             'code' => 'failed'
    //         ], 400);
    //     }
    // }

    public function getUsersData(Request $request)
    {
        $input = $request->all();
        $rolename  = \Arr::get($input,'role','');
        try {
            $query = DB::table('customers');
            if (!empty($rolename)) {
                if ($rolename == 'admin')
                    $query->where('role', '!=','admin');
            }
            $userlist = $query->select('customer_id', 'name', 'email', 'mobileno', 'image', 'role', 'status')
                ->get();
            return response()->json([
                'status' => 200,
                'code' => 'success',
                'data' => $userlist
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function getMyData(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $query = DB::table('customers as c')
                    ->where('c.customer_id', $input)
                    ->select('c.customer_id as customer_id', 'c.name as name', 'c.email as email', 'c.mobileno as mobileno', 'c.image as image', 'c.role as role', 'c.status as status')
                    ->get();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $query
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function createCategory(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $validator = Validator::make($request->all(), [
                    'category' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Invalid Details'
                    ], 400);
                } else {
                    $category = new Category;
                    $category->category_name = $input['category'];
                    $category->customer_id = $input['id'];
                    $category->save();
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            // \Log::info($e);
            // return $e;
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    // public function getAllCategoryData()
    // {
    //     try {
    //         $query = DB::table('category as c')
    //             ->select('c.category_id as category_id', 'c.category_name as category_name')
    //             ->get();
    //         return response()->json([
    //             'status' => 200,
    //             'code' => 'success',
    //             'data' => $query
    //         ], 200);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 400,
    //             'code' => 'failed'
    //         ], 400);
    //     }
    // }
    public function getAllCategoryData()
    {
        try {
            $query = DB::table('category as ct')
                ->leftjoin('customers as c', 'ct.customer_id', '=', 'c.customer_id')
                ->select('ct.category_id as category_id', 'ct.category_name as category_name', 'ct.customer_id as customer_id', 'c.name as customer_name', 'c.customer_id as customer_id')
                ->get();
            return response()->json([
                'status' => 200,
                'code' => 'success',
                'data' => $query
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }
    public function getBlogDetails(Request $request)
    {
        $input = $request->all();
        try {
            if (!empty($input)) {
                $query = DB::table('blog as b')
                    ->leftjoin('customers as c', 'b.customer_id', '=', 'c.customer_id')
                    ->join('category as ct', 'b.category_id', '=', 'ct.category_id')
                    ->where('b.slug', $input)
                    ->select('b.slug as slug', 'ct.category_id as category_id', 'ct.category_name as category_name', 'b.title as title', 'b.description as description', 'c.name as name', 'b.image as image', 'b.created_at as created_at')
                    ->first();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $query
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function getCategoryBlog(Request $request){
        $input = $request->all();
        try {
            if (!empty($input)) {
                $query = DB::table('blog as b')
                    ->leftjoin('customers as c', 'b.customer_id', '=', 'c.customer_id')
                    ->join('category as ct', 'b.category_id', '=', 'ct.category_id')
                    ->where('ct.category_name', $input)
                    ->select('b.slug as slug', 'ct.category_id as category_id', 'ct.category_name as category_name', 'b.title as title', 'b.description as description', 'c.name as name', 'b.image as image', 'b.created_at as created_at')
                    ->get();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $query
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function getCategoryData(Request $request)
    {
        $input = $request->all();
        $customer_id = \Arr::get($input, 'customer_id', '');
        $category_name = \Arr::get($input, 'category_name', '');
        try {
            $query = DB::table('customers as c')
                ->join('category as ct', 'c.customer_id', '=', 'ct.customer_id');
            if (!empty($category_name) && !empty($customer_id)) {
                $query->where('ct.category_name', 'like' ,"%$category_name%");
                $query->where('c.customer_id', $customer_id);
            } elseif (!empty($category_name)) {
                $query->where('ct.category_name', 'like', "%$category_name%");
            } elseif (!empty($customer_id)) {
                $query->where('c.customer_id', $customer_id);
            }
            $query = $query->select('ct.category_id as category_id', 'ct.category_name as category_name', 'ct.status as status', 'c.name as customer_name', 'c.customer_id as customer_id')
            ->get();
            return response()->json([
                'status' => 200,
                'code' => 'success',
                'data' => $query
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function editCategoryPage(Request $request){
        $input = $request->all();
        try {
            if (!empty($input)) {
                $category = Category::where('category_id', $input)->first();
                return response()->json([
                    'status' => 200,
                    'code' => 'success',
                    'data' => $category
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function postEditCategory(Request $request){
        $input = $request->all();
        // \Log::info($input);
        try {
            if (!empty($input)) {
                $category = Category::where('category_id', $input['id'])->update([
                    'category_name' => $input['category'],
                ]);
                // \Log::info($category);
                if ($category == 1) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 400,
                        'code' => 'failed',
                    ], 400);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function updateCategoryStatus(Request $request){
        $inputs = $request->all();
        try {
            if (!empty($inputs)) {
                $category_id = \Arr::get($inputs,'category_id','');
                $category_status = \Arr::get($inputs,'category_status','');
                $data = Category::where('category_id', $category_id)->update(['status' => $category_status]);
                if ($data == 1) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                } else {
                    return false;
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

    public function updateBlogStatus(Request $request){
        $inputs = $request->all();
        \Log::info($inputs);
        try {
            if (!empty($inputs)) {
                $blog_id = \Arr::get($inputs,'blog_id','');
                $blog_status = \Arr::get($inputs,'blog_status','');
                $data = Blog::where('blog_id', $blog_id)->update(['status' => $blog_status]);
                if ($data == 1) {
                    return response()->json([
                        'status' => 200,
                        'code' => 'success',
                    ], 200);
                } else {
                    return false;
                }
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Input Not Found'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 400,
                'code' => 'failed'
            ], 400);
        }
    }

}









// public function getAllCategoryData()
//     {
//         try {
//             $query = DB::table('category as ct')
//                 ->leftjoin('customers as c', 'ct.customer_id', '=', 'c.customer_id')
//                 ->select('ct.category_id as category_id', 'ct.category_name as category_name','ct.customer_id as customer_id','c.name as customer_name','c.customer_id as customer_id')
//                 ->get();
//             return response()->json([
//                 'status' => 200,
//                 'code' => 'success',
//                 'data' => $query
//             ], 200);
//         } catch (Exception $e) {
//             return response()->json([
//                 'status' => 400,
//                 'code' => 'failed'
//             ], 400);
//         }
//     }

  






