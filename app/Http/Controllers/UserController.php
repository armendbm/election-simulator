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
    function delete($id){
        $data = User::findOrFail($id);
        $data->delete();
        Alert::warning('Account Deleted', ' Your account have been deleted!');
        return redirect('/');//->with('alert', 'Account Deleted!');
    }

    function update($id){
        $data = User::find($id);
        // $data->password = Crypt::decrypt($data->password); 
        return view('update', ['data' => $data]);
    }

    function updatePassword($id){
        $data = User::find($id);
        // $data->password = Crypt::decrypt($data->password); 
        return view('updatepassword', ['data' => $data]);
    }

    function edit(Request $req){
        $this->validate($req, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
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
        $data->email = $req->email;
        $data->password = bcrypt($req->password);
        $data -> save();
        Alert::success('Success', 'Your post is saved');
        return redirect('/dashboard');
    }
}
