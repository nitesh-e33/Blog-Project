<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Auth;
use Session;

use App\Models\Customer;
use App\Models\Blog;

class EditController extends Controller
{
    public function editProfile($id){

        $customer = Customer::where('customer_id',$id)->first();
        return view('edit',compact('customer'));
    }

    public function postEditProfile(Request $request,$id){
        $input=$request->all();
       
       $customers = Customer::where('customer_id',$id)->update([
           'name' => $input['name'],
           'email' => $input['email'],
           'mobileno' => $input['mobile']
            
       ]);
       return redirect('/signin');
           // $customer = Customer::where('customer_id',$id);
           // $customer->name = $request['name'];
           // $customer->mobileno = $request['mobile'];
           // $customer->email = $request['email'];

           // if($request->hasFile('image')){
           //     $destination = 'uploads/customers'.$customer->image;
           //     if(File::exists($destination)){
           //         File::delete($destination);
           //     }
           //     $file = $request->file('image');
           //     $extension = $file->getClientOriginalExtension();
           //     $filename = time().'.'.$extension;
           //     $file->move('uploads/customers',$filename);
           //     $customer->image = $filename;
           // }
           // $customer->save();
           // return redirect('/view');
           // return redirect('/signin');        
   }

   public function editBlog($id){
    $blog = Blog::where('id',$id)->first();
    return view('edit-blog',compact('blog'));
}
}
