<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UpdatePassword(Request $request){
        $current_user=auth()->user();
        if(Hash::check($request->old_password,$current_user->password)){
            $current_user->update([
              'password'=>bcrypt($request->new_password)
            ]);
            return response()->json(['response'=>'success','you can now try with your new password']);
        }else{
            return response()->json(['response'=>'some information are wrong'],404);
        }
    } 

    public function update(Request $request)
    {
        //
        $profile =Auth::user();
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->save();
    }
}
