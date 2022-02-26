<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;
use SweetAlert;


class UserController extends Controller
{
    //

    // Below are the functions created for Dashboard ==================================================
    function delete($id){
        $data = User::findOrFail($id);
        $data->delete();   
        Alert::warning('Account Deleted', ' Your account have been deleted!');
        return redirect('/');
    }

    function updateUserName($id){
        $data = User::find($id);
        return view('updateUserName', ['data' => $data]);
    }

    function updatePassword($id){
        $data = User::find($id);
        // $data->password = Crypt::decrypt($data->password); 
        return view('updatePassword', ['data' => $data]);
    }

    function updateEmail($id){
        $data = User::find($id);
        return view('updateEmail', ['data' => $data]);
    }

    function editUserName(Request $req){
        $this->validate($req, [  'name' => 'required|unique:users'  ]);
        // $data = User::find($req->id);
        // return $req->input();

        // $user->find($req->id);
        // return $user;
        // $this->validate($req, [
        //     'name'=> 'required',
        //     'email'=> 'required',
        //     'password'=> 'required' 
        // ]);

        // $user->update([
        //     'name' => $req->name,
        //     'email' => $req->email,
        //     'password' => $req->password
        // ]);
        $data = User::find($req->id);
        $data->name = $req->name;
        $data -> save();
        Alert::success('Success', 'Your information has changed!');
        return redirect('/dashboard');
    }

    function editPassword(Request $req){
        $temp = $req->password1;
        $temp2 = $req->password;
        if($temp == $temp2){
            $this->validate($req, [  'password' => 'required|min:8'  ]);
            $data = User::find($req->id);
            $data->password = bcrypt($req->password);
            $data -> save();
            Alert::success('Success', 'Your password has changed!');
            return redirect('/dashboard');
        }else{
            Alert::error('Fail', 'Two passwords did not match');
            return redirect('/dashboard');
        }
        
    }

    function editEmail(Request $req){
        $this->validate($req, [  'email' => 'required|email|unique:users'  ]);
        $data = User::find($req->id);
        $data->email = $req->email;
        $data -> save();
        Alert::success('Success', 'Your Email has changed!');
        return redirect('/dashboard');
    }
    // Above are the functions created for Dashboard ==================================================
}
