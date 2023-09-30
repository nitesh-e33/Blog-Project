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
class CategoryController extends Controller
{
    const API_URL = 'local.demo.in/api';

    public function createCategory()
    {
        return view('category');
    }

    public function postCreateCategory(Request $request)
    {
        // $role = session()->get('role');
        $customer_id = session()->get('customer_id');
        $input = $request->all();
        $input['id'] = $customer_id;
        // $input['role'] = $role;
        $request->validate(
            [
                'category' => 'required',
            ]
        );
        $apiUrl = self::API_URL . "/create-category";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            return redirect('/admin/category-list');
        } else {
            return back()->with('failed', 'Found Duplicate Category');
        }
    }

    public function categoryListing(Request $request){
        $inputs = $request->all();
        // echo '<pre>';print_r($inputs);die;
        $role = session()->get('role');
        $userlist = []; 
        if ($role == 'admin') {
            // User Data Get
            $resUser = Http::post(self::API_URL. "/get-users-data");
            $userdata = json_decode($resUser,true);
            if(\Arr::get($userdata,'code','')=='success'){
                $userlist = \Arr::get($userdata,'data',[]);
            }
            // Get category List
            $response = Http::post(self::API_URL . "/get-category-details",$inputs);
            $response = json_decode($response,true);
            if(\Arr::get($response,'code','')=='success'){
                $catlist = \Arr::get($response,'data',[]);
                // echo '<pre>';print_r($catlist);die;
            }
            return view('category-listing', compact('userlist','catlist','inputs'));
        } else {
            $inputs['customer_id'] = session()->get('customer_id');
            $response = Http::post(self::API_URL . "/get-category-details",$inputs);
            $response = json_decode($response,true);
            // echo '<pre>';print_r($response);die;

            if(\Arr::get($response,'code','')=='success'){
                $catlist = \Arr::get($response,'data',[]);
            }
            return view('user-category-list',compact('catlist','inputs'));
        }
    }

    public function editCategory($id)
    {
        $input['id'] = $id;
        $apiUrl = self::API_URL . "/edit-category-page";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        // echo '<pre>';print_r($response);die;
        $category = $response->data;
        if ($response->code == 'success') {
            return view('editCategory', compact('category'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function postEditCategory(Request $request,$id){
        $input = $request->all();
        $input['id'] = $id;
        // echo '<pre>';print_r($input);die;
        $apiUrl = self::API_URL."/post-edit-category";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        // echo '<pre>';print_r($response);die;
        if ($response->code == 'success') {
            return redirect('/admin/category-list')->with('success','Edit Successfully');
        } else {
                return back()->with('failed', 'Something went wrong');
        }
    }

    public function changeCategoryStatus(Request $request){
        $input = $request->all();
        \Log::info($input);
        $apiUrl = self::API_URL."/change-category-status";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response,true);
        \Log::info($response);
        if ($response['code'] == 'success') {
            return true;
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

    public function categoryBlog($category_name){
        $input['category_name'] = $category_name;
        $apiUrl = self::API_URL . "/category-blog";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response, true);
        $result = \Arr::get($response, "data", []);
        $recordsPerPage = 10;
        $totalRecords = count($result);
        if ($response['code'] == 'success') {
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($result);
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $recordsPerPage, $recordsPerPage)->all();
            if (!empty($currentPageSearchResults)) {
                $blogs = new LengthAwarePaginator($currentPageSearchResults, $totalRecords, $recordsPerPage);
                return view('category-blog', compact('blogs'));
            } else {
                return back()->with('failed', 'something went wrong');
            }
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }
}
