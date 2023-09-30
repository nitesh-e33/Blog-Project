<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = "customers";
    protected $primaryKey = "customer_id";


    // public static function postInsert(Request $request)
    // {
    //     $customer = new Customer;
    //     $customer->name = $request['name'];
    //     $customer->mobileno = $request['mobileno'];
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $extension = $file->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $file->move('uploads/customers', $filename);
    //         $customer->image = $filename;
    //     }
    //     $customer->email = $request['email'];
    //     $customer->password = md5($request['password']);
    //     $customer->role = "user";
    //     $customer->status = "Inactive";
    //     $res = $customer->save();
    //     if ($res) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function loginCheck(Request $request)
    // {
    //     $filled_email = Arr::get($request, 'email');
    //     $filled_pass = md5(Arr::get($request, 'password'));
    //     $user = Customer::where('email', '=', $filled_email, '')->first();
    //     $email = $user->email;
    //     $password = $user->password;
    //     if ($filled_email == $email && $filled_pass == $password && ($user->status == 'active' || $user->status == 1)) {
    //         $request->session()->put("userdata", $user);
    //         if($user->status == 1){
    //             return "admin";
    //         }
    //         return "user";
    //     } else {
    //         return false;
    //     }
    // }

    // public static function updateProfile(Request $request, $id)
    // {
    //     $input = $request->all();
    //     $customers = Customer::where('customer_id', $id)->update([
    //         'name' => $input['name'],
    //         'email' => $input['email'],
    //         'mobileno' => $input['mobile']

    //     ]);
    //     if ($customers == 1) {
    //         $user = Customer::where('customer_id', $id)->first();
    //         $request->session()->flash('userdata');
    //         $request->session()->put("userdata", $user);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function updateStatus(Request $request){
    //     $input = $request->all();
    //     $user_id = $input['user_id'];
    //     $status = $input['user_status'];
    //     $data = Customer::where('customer_id', $user_id)->update(['status' => $status]);
    //     if ($data == 1) {
    //         return $data;
    //     } else {
    //         return false;
    //     }
    // } 


    // public static function getUsersData()
    // {
    //     $role = session()->get('role');
    //     // $role = $user['role'];
    //     $query = DB::table('customers as c')
    //         ->where('c.role', '!=', $role)
    //         ->select('c.customer_id as customer_id', 'c.name as name', 'c.email as email', 'c.mobileno as mobileno', 'c.image as image', 'c.role as role', 'c.status as status')
    //         ->get();
    //     return $query;
    // }

    // public static function getMydata(){
    //     $customer_id = session()->get('customer_id');
    //     // echo $customer_id;die;
    //     // $role = $user['role'];
    //     $query = DB::table('customers as c')
    //         ->where('c.customer_id', $customer_id)
    //         ->select('c.customer_id as customer_id', 'c.name as name', 'c.email as email', 'c.mobileno as mobileno', 'c.image as image', 'c.role as role', 'c.status as status')
    //         ->get();
    //     return $query;
    // }
}
