<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use  HasFactory;
    protected $table = "blog";
    protected $primaryKey = "blog_id";

    // public static function createdBlog(Request $request)
    // {
    //     $blog = new Blog;
    //     $blog->title = $request['title'];
    //     $blog->description = $request['description'];

    //     $blog->customer_id  = session()->get('customer_id');
    //     // $blog->customer_id = $user['customer_id'];

    //     $res = $blog->save();
    //     if ($res) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function updateBlog(Request $request, $id)
    // {
    //     $input = $request->all();
    //     $blog = Blog::where('blog_id', $id)->update([
    //         'title' => $input['title'],
    //         'description' => $input['description'],
    //     ]);
    //     if ($blog == 1) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function dltBlog(Request $request)
    // {
    //     $input = $request->all();
    //     $response = Blog::where('blog_id', $input)->delete();
    //     if ($response == 1)
    //         return $response;
    //     else
    //         return false;
    // }

    // public static function getBlogData()
    // {
    //     $customer_id = session()->get('customer_id');
    //     // $customer_id = $user['customer_id'];
    //     // echo '<pre>'; print_r($customer_id); die;
    //     $query = DB::table('blog as b')
    //         ->join('customers as c', 'b.customer_id', '=', 'c.customer_id')
    //         ->where('b.customer_id', $customer_id)
    //         ->select('b.blog_id as blog_id', 'b.title as title', 'b.description as description')
    //         ->get();
    //     return $query;
    // }

    // public static function getuserBlogData($id)
    // {
    //     $query = DB::table('blog as b')
    //         ->join('customers as c', 'b.customer_id', '=', 'c.customer_id')
    //         ->where('b.customer_id', $id)
    //         ->select('b.blog_id as blog_id', 'b.title as title', 'b.description as description','c.name as name')
    //         ->get();
    //     return $query;
    // }
}
