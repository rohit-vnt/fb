<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class Api extends Controller
{
    //
    public function register(Request $request){
        $data=$request->validate(
        [
            'name'=>'required|string',
            'mobile'=>'required|string|unique:users',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password'=>'required|string|same:password',
        ]);
        $data['password']=bcrypt($data['password']);
        $data['type']=1; // type admin
        $admin=new User($data);
        if($admin->save()){
            return response()->json([
                'message' => 'Admin registered',
                'type'=>'success'
              ], 201);
        }else{
            return response()->json([
            'message' => 'Oops! Operation failed',
            'type'=>'failed'
            ], 401);
        }
    }
    public function login(Request $request){
        $request->validate([
            'mobile'=>'required|string',
            'password'=>'required|string',
        ]);
        $user = User::where('mobile', $request->mobile)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message'=>'Unauthorized',
                'type'=>'failed'
                ]);
        }else{
            $token=$user->createToken('token')->plainTextToken;
            return response()->json([
                'user'=>$user,
                'token'=>$token
                ]);
        }
    }
    // create company
    public function company(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'license_name'=>'required|string',
            'license_no'=>'required|string',
            'address'=>'required|string',
            'pan_no'=>'required|string',
            'gst_no'=>'required|string',
        ]);
        $company=new Company($data);
        if($company->save()){
            return response()->json([
                'message' => 'Company Added',
                'type'=>'success'
              ], 201);
        }
        else{
            return response()->json([
                'message' => 'Oops! Operation failed',
                'type'=>'failed'
                ], 401);
        }
    }
    // create branches
    public function branch(Request $request){
        $data=$request->validate([
            'company_id'=>'required|string',
            'name'=>'required|string',
            'address'=>'required|string',
            'city'=>'required|string',
            'pincode'=>'required|string',
        ]);
        $data['created_by']=$request->user()->id;
        $company=new branch($data);
        if($company->save()){
            return response()->json([
                'message' => 'Branch Added',
                'type'=>'success'
              ], 201);
        }
        else{
            return response()->json([
                'message' => 'Oops! Operation failed',
                'type'=>'failed'
                ], 401);
        }
    }
    // create user
    public function user(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'license_name'=>'required|string',
            'license_no'=>'required|string',
            'address'=>'required|string',
            'pan_no'=>'required|string',
            'gst_no'=>'required|string',
        ]);
        $company=new Company($data);
        if($company->save()){
            return response()->json([
                'message' => 'Company Added',
                'type'=>'success'
              ], 201);
        }
        else{
            return response()->json([
                'message' => 'Oops! Operation failed',
                'type'=>'failed'
                ], 401);
        }
    }
    // create supplier
    public function supplier(Request $request){
        $data=$request->validate([
            'name'=>'required|string',
            'contact_person'=>'required|string',
            'mail'=>'required|string',
            'mobile'=>'required|string',
            'landline'=>'required|string',
            'license_no'=>'required|string',
            'address'=>'required|string',
            'pincode'=>'required|string',
            'city'=>'required|string',
        ]);
        $data['created_by']=$request->user()->id;
        $company=new Supplier($data);
        if($company->save()){
            return response()->json([
                'message' => 'Supplier Added',
                'type'=>'success'
              ], 201);
        }
        else{
            return response()->json([
                'message' => 'Oops! Operation failed',
                'type'=>'failed'
                ], 401);
        }
    }
    public function test(){
        return "Test";
    }
    // get company
    public function getCompanies(){
        $data=Company::where('status',1)->get();        
        if($data){
            return response()->json([
                'data'=>$data,
                'type'=>'success'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Oops! operation failed!',
                'type'=>'failed'
            ]);
        }
    }
    
    // get branch
    public function getBranch(){
        $data=branch::where('status',1)->get();        
        if($data){
            return response()->json([
                'data'=>$data,
                'type'=>'success'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Oops! operation failed!',
                'type'=>'failed'
            ]);
        }
    }
    // get Users
    public function getUsers(){
        $data=User::where('status',1)->get();        
        if($data){
            return response()->json([
                'data'=>$data,
                'type'=>'success'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Oops! operation failed!',
                'type'=>'failed'
            ]);
        }
    }
    // get supplier
    public function getSupplier(){
        $data=Supplier::where('status',1)->get();        
        if($data){
            return response()->json([
                'data'=>$data,
                'type'=>'success'
            ]);
        }
        else{
            return response()->json([
                'message'=>'Oops! operation failed!',
                'type'=>'failed'
            ]);
        }
    }
        
}
