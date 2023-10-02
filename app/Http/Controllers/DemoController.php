<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Session;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

use Illuminate\Pagination\Paginator;


class DemoController extends Controller
{
    const API_URL = 'local.demo.in/api';

    public function getSignup(){
        return view('home1');
    }

    public function postSignup(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                'name' => 'required|alpha',
                'mobileno' => 'required|numeric|digits:10',
                'email' => 'required|email|unique:customers',
                'image' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]
        );
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/customers', $filename);
            // $filename = $request->file('image')->store('user_images', 'public');
            $input['image'] = $filename;
        }
        $apiUrl = self::API_URL."/register";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if($response->code == 'success'){
            return redirect('signin')->with('success', 'You have registered successfully'); 
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function getSignin()
    {    
        if (!(session()->get('customer_id'))) {
            return view('signin');
        } else {
            $role = session()->get('role');
            if($role == 'admin') {
                return redirect('/admin/myaccount');
            } else {
                return redirect('/my-account');
            }
        }     
    }

    public function postSignin(Request $request)
    {
        $input = $request->all();
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $apiUrl = self::API_URL."/login";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            Session()->put("customer_id", $response->data->customer_id);
            Session()->put("role", $response->data->role);
            $role = session()->get('role');

            if ($role == 'admin') {
                return redirect('/admin/myaccount')->with('success', 'Login successfully');
            } else {
                return redirect('/my-account')->with('success', 'Login successfully');
            } 
        } else {
            return back()->with('failed', 'Login Details are not valid or Inactive User');
        }
    }

    public function getLogout()
    {
        session()->flush();
        return redirect('/signin')->with('success', 'Logged out successfully');
    }

    public function myAccount()
    {
        $role = session()->get('role');
        $customer_id = session()->get('customer_id');
        if ($role == 'admin') {
            $input['role'] = $role;

            $apiUrl = self::API_URL. "/get-users-data";
            $response = Http::post($apiUrl, $input);
            $response = json_decode($response);
            $userdata = $response->data;
            if ($response->code == 'success') {
                return view('admin-view', compact('userdata'));
            } else {
                return back()->with('failed', 'something went wrong');
            }
        } else {
            $input['customer_id'] = $customer_id;

            $apiUrl = self::API_URL. "/get-my-data";
            $response = Http::post($apiUrl, $input);
            $response = json_decode($response);
            $mydata = $response->data;
            if ($response->code == 'success') {
                return view('customer-view', compact('mydata'));
            } else {
                return back()->with('failed', 'something went wrong');
            }
        }
    }

    public function editProfile($id)
    {
        $input['id'] = $id;
        $apiUrl = self::API_URL. "/edit-profile-page";
        $response = Http::post($apiUrl, $input);
        $response = json_decode($response);
        $customer = $response->data;
        if ($response->code == 'success') {
            return view('edit', compact('customer'));
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function postEditProfile(Request $request, $id)
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
        $apiUrl = self::API_URL."/edit-profile";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            Session()->put("customer_id", $response->data->customer_id);
            Session()->put("role", $response->data->role);
            return redirect('/my-account');
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

        // $input['customer_id'] = $id;
        // echo $input['customer_id'];die;


        // $resUser = Http::post(self::API_URL. "/get-users-data");
        //     $userdata = json_decode($resUser,true);
        //     if(\Arr::get($userdata,'code','')=='success'){
        //         $userlist = \Arr::get($userdata,'data',[]);
        //     }
        // echo '<pre>';print_r($response);die;
        // if ($response->code == 'success') {
            // $blogdata = $response->data;

    public function postChangeStatus(Request $request)
    {
        $input = $request->all();
        $apiUrl = self::API_URL."/change-status";
        $response = Http::post($apiUrl,$input);
        $response = json_decode($response);
        if ($response->code == 'success') {
            return true;
        } else {
            return back()->with('failed', 'Something went wrong');
        }
    }

    public function newsBlog()
    {
        $page = 1;
        $apiUrl = self::API_URL . "/all-blog-data";
        $response = Http::post($apiUrl);
        $response = json_decode($response, true);
        $result = \Arr::get($response, "data", []);
        // echo '<pre>';print_r($result);die;
        $recordsPerPage = 10;
        $totalRecords = count($result);
        if ($response['code'] == 'success') {
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $collection = new Collection($result);
            $currentPageSearchResults = $collection->slice(($currentPage - 1) * $recordsPerPage, $recordsPerPage)->all();
            if (!empty($currentPageSearchResults)) {
                $blogs = new LengthAwarePaginator($currentPageSearchResults, $totalRecords, $recordsPerPage);
                // echo '<pre>';print_r($blogs);die;
                return view('welcome', compact('blogs'));
            } else {
                return back()->with('failed', 'something went wrong');
            }
        } else {
            return back()->with('failed', 'something went wrong');
        }
    }

    public function aboutPage()
    {
        return view('about');
    }

    public function categoryPage()
    {
        return view('categories');
    }

    public function contactPage()
    {
        return view('contact');
    }

    public function postFeedback()
    {
        return view('feedback');
    }

}