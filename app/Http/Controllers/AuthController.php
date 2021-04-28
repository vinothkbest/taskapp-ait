<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Admin;
use App\Models\User;

class AuthController extends Controller
{
    public function adminLogin(Request $request){
	    $validator = Validator::make($request->all(), [
	    	'email' => 'required|email',
	    	'password' => 'required'
	    ]);
	    if($validator->fails()){
	    	return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
	    }
	    else{

		    if(Auth::guard('admin')->attempt($request->only('email', 'password'))){
		    	Auth::guard('admin')->user()->tokens()->delete();
		    	$token = Auth::guard('admin')->user()->createToken($request->email, ['admin'])->plainTextToken;
		    	return response()->json(['status' => 'success', 'message' => 'Login successfully', 'admin' => Auth::guard('admin')->user(), 'token' => $token], 200);
		    }
		    else
		    	return response()->json(['status' => 'error', 'message' => 'Invalid credentials'], 400);
	    }
   	}

   	public function adminLogout(){
	    request()->user()->tokens()->where(['tokenable_id'=> Auth::id(), 'tokenable_type'=> 'Admin'])->delete();
        return response()->json(['message' => 'Loggedout successfully', 'status' => 'success'], 200);
   	}

   	public function userLogin(Request $request){
	    $validator = Validator::make($request->all(), [
	    	'email' => 'required|email',
	    	'password' => 'required'
	    ]);
	    if($validator->fails()){
	    	return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 400);
	    }
	    else{

		    if(Auth::attempt($request->only('email', 'password'))){
		    	Auth::user()->tokens()->delete();
		    	$token = Auth::user()->createToken($request->email, ['user'])->plainTextToken;
		    	return response()->json(['status' => 'success', 'user' => Auth::user(), 'token' => $token], 200);
		    }
		    else
		    	return response()->json(['status' => 'success', 'message' => 'Invalid login'], 400);
	    }
   	}

   	public function userLogout(){
   		request()->user()->tokens()->where(['tokenable_id'=> Auth::id(), 'tokenable_type'=> 'Users'])->delete();
        return response()->json(['message' => 'Loggedout successfully', 'status' => 'success'], 200);
   	}
}
