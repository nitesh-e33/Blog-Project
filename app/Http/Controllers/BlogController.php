<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Session;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    const API_URL = 'local.demo.in/api';

    public function deleteBlog(Request $request)
    {
        $input = $request->all();
        $apiUrl = self::API_URL."/delete-blog";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            return true;
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

    public function createBlog(){
        $apiUrl = self::API_URL."/all-category-data";
        $response = Http::get($apiUrl);
        $response = json_decode($response);
        $category_data = $response->data;
        if ($response->code == 'success') {
            return view('blog', compact('category_data'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function postCreatedBlog(Request $request)
    {
        $input = $request->all();
        // echo '<pre>';print_r($input);die;
        $request->validate(
            [
                'category' => 'required',
                'title' => 'required',
                'description' => 'required',
                'image' => 'required',
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/customers', $filename);
            $input['image'] = $filename;
        }
        $slug = Str::slug($request->title,'-');
        $input['slug'] = $slug;
        $customer_id = session()->get('customer_id');
        $input['customer_id'] = $customer_id;
        $apiUrl = self::API_URL. "/create-blog";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        // echo '<pre>';print_r($response);die;
        if ($response->code == 'success') {
            return redirect('/all-blog')->with('success', 'Blog Created successfully');
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function editBlog($id)
    {
        $input['id'] = $id;
        $apiUrl = self::API_URL. "/edit-blog-page";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        $blog = $response->data;
        if ($response->code == 'success') {
            return view('editBlog', compact('blog'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function postEditBlog(Request $request, $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/customers', $filename);
            $input['image'] = $filename;
        }
        // echo '<pre>';print_r($input);die;
        $apiUrl = self::API_URL."/edit-blog";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            return redirect('/blog-list')->with('success','Edit Successfully');
        } else {
                return back()->with('failed', 'Something went wrong');
        }
    }

    public function adminEditBlog($id)
    {
        $input['id'] = $id;
        $apiUrl = self::API_URL. "/edit-blog-page";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        // echo '<pre>';print_r($response);die;
        $blog = $response->data;
        if ($response->code == 'success') {
            return view('admin-edit-blog', compact('blog'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function postAdminEditBlog(Request $request, $id)
    {
        $input = $request->all();
        $input['id'] = $id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/customers', $filename);
            $input['image'] = $filename;
        }
        $apiUrl = self::API_URL."/edit-blog";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            $blog = Blog::where('blog_id', $id)->first();
            $customer_id = $blog['customer_id'];
            return redirect('/admin/blog-list')->with('success','Edit Successfully');
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

    public function userBlog(Request $request)
    {
        $page = 1;
        $inputs = $request->all();
        // echo '<pre>';print_r($inputs);die;
        $role = session()->get('role');
        $inputs['role'] = $role;
        $userlist = [];
        $recordsPerPage = 10;

        $apiUrl = self::API_URL . "/all-category-data";
        $response = Http::get($apiUrl);
        $response = json_decode($response, true);
        if (\Arr::get($response, 'code', '') == 'success') {
            $category_data = \Arr::get($response, 'data', []);
        } else {
            return back()->with('failed', 'something went wrong');
        }


        if ($role == 'admin') {
            // User Data Get
            $resUser = Http::post(self::API_URL . "/get-users-data");
            $userdata = json_decode($resUser, true);
            if (\Arr::get($userdata, 'code', '') == 'success') {
                $userlist = \Arr::get($userdata, 'data', []);
            }
            //get Blog Data
            $apiUrl = self::API_URL . "/all-blog-data";
            $response = Http::post($apiUrl, $inputs);
            $response = json_decode($response, true);
            if (\Arr::get($response, 'code', '') == 'success') {
                $result = \Arr::get($response, 'data', []);
                // echo '<pre>';print_r($result);die;
            }
            $totalRecords = count($result);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($result);
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $recordsPerPage, $recordsPerPage)->all();
            if (!empty($currentPageSearchResults)) {
                $bloglist = new LengthAwarePaginator($currentPageSearchResults, $totalRecords, $recordsPerPage);
                $bloglist->setPath('/admin/blog-list');
                return view('admin-blog-view', compact('bloglist', 'userlist', 'inputs', 'category_data'));
            }
        } else {
            $inputs['customer_id'] = session()->get('customer_id');
            //get Blog Data
            $apiUrl = self::API_URL . "/all-blog-data";
            $response = Http::post($apiUrl, $inputs);
            $response = json_decode($response, true);
            // echo '<pre>';print_r($response);die;
            if (\Arr::get($response, 'code', '') == 'success') {
                $result = \Arr::get($response, 'data', []);
            }
            $totalRecords = count($result);
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($result);
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $recordsPerPage, $recordsPerPage)->all();
            if (!empty($currentPageSearchResults)) {
                $bloglist = new LengthAwarePaginator($currentPageSearchResults, $totalRecords, $recordsPerPage);
                $bloglist->setPath('/blog-list');
                return view('blog-view', compact('bloglist', 'inputs', 'category_data'));
            }
        }
    }

    public function readBlog($slug)
    {
        $input['slug'] = $slug;
        $apiUrl = self::API_URL . "/get-blog-details";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            $blog = $response->data;
            // echo '<pre>';print_r($blog);die;
            return view('blog-details', compact('blog'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function updateBlogStatus(Request $request){
        $input = $request->all();
        \Log::info($input);
        $apiUrl = self::API_URL."/change-blog-status";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response,true);
        \Log::info($response);
        if ($response['code'] == 'success') {
            return true;
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }
}
