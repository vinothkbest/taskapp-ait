<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Hash;
class UserController extends Controller
{
   public function index(){
        $users=User::orderByDesc('created_at')->get();
        return response()->json(['status'=>true, 'users' => $users], 200);
   }

   public function save(Request $request){

         $validation = Validator::make($request->all(), [
                        'gender' => 'required|boolean',
                        'name' => 'required',
                        'email' => 'required|email|unique:users,email',
                        'mobile' => 'required|phone|unique:users,mobile',
                        'password' => 'required|min:5',
                  ],[
                      'mobile.phone' =>'Invalid mobile number.'
                  ]);

         if($validation->fails())
               return response()->json(['message' => $validation->errors()->first(), 'status' => 'error'], 400);

         $user = ['password' => Hash::make($request->password), 'name' => ucfirst($request->name), 'gender' => $request->gender, 'email' => $request->email, 'mobile' => $request->mobile];  
         User::create($user);

         return response()->json(['message' => 'New user added successfully', 'status' => 'success'], 201);
   }

   public function edit($user){

        return response()->json(['user' => User::find($user), 'status' => 'success'], 200);
   }

   public function delete($user){
        User::find($user)->delete();
        return response()->json(['message' => 'User deleted successfully', 'status' => 'success'], 200);
   }

   public function update(Request $request, $id){

         $validation = Validator::make($request->all(), [
                        'gender' => 'required|boolean',
                        'name' => 'required',
                        'email' => 'required|email',
                        'mobile' => 'required|phone',
                  ],[
                      'mobile.phone' =>'Invalid mobile number.'
                  ]);

         if($validation->fails())
               return response()->json(['message' => $validation->errors()->first(), 'status' => 'error'], 400);

         if($request->password){

          $validation = Validator::make($request->all(), [
                        'password' => 'required|min:5',
                  ]);

           if($validation->fails())
                 return response()->json(['message' => $validation->errors()->first(), 'status' => 'error'], 400);

            $user = ['password' => Hash::make($request->password), 'name' => ucfirst($request->name), 'gender' => $request->gender, 'email' => $request->email, 'mobile' => $request->mobile];
         }
         else{
          $user = ['name' => ucfirst($request->name), 'gender' => $request->gender, 'email' => $request->email, 'mobile' => $request->mobile];
         }

         User::where('id', $id)->update($user);

         return response()->json(['message' => "User updated successfully", 'status' => 'success'], 201);
   }
}

