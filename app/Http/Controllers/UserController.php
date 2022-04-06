<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * UserController Class functions to create, edit, and store
 * users in the mySQL database.
 * 
 * Interactions:
 *      -all User->Auth() calls to check login status and user ID number
 *      -dashboard.blade.php subsidary web views for account managment.
 * 
 *  User Schema:
 *      User -> [id, name, email, emal_verifified_at, password, remember_token, created_at, updated_at]
 *          id                  -> unique vote id integer
 *          name                -> unique id SQL index of the user who casted the vote
 *          email               -> unique id SQL index of the election to which this vote relates
 *          email_verified_at   -> time id for when the user verified their email in the form Y/M/D Time eg. "2022-03-01 14:59:59" not currently implemented for use
 *          remember_token      -> currently not implemented for use
 *          created_at          -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at          -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 * 
 *   member functions:
 *      delete($id)
 *      editUserName($req)
 *      editPassword($req)
 *      editEmail($req)
 */

class UserController extends Controller
{
    /**
     * Deletes user from database, confirms with an alert window
     * 
     * Called by dashboard.blade.php
     */
    function delete($id){
        $data = User::findOrFail($id);
        $data->delete();   
        Alert::warning('Account Deleted', ' Your account have been deleted!');
        return redirect('/');
    }

    /**
     * edits username if the new name is unique
     * 
     * called by dashboard.blade.php
     */
    function editUserName(Request $req){
        $this->validate($req, [  'name' => 'required|unique:users'  ]);
        $data = User::find($req->id);
        $data->name = $req->name;
        $data -> save();
        Alert::success('Success', 'Your information has changed!');
        return redirect('/dashboard');
    }

    /**
     * edits username given it satisfies password requirements
     * 
     * called by dashboard.blade.php
     */
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

    /**
     * edits username given it is unique to the database
     * 
     * called by dashboard.blade.php
     */
    function editEmail(Request $req){
        $this->validate($req, [  'email' => 'required|email|unique:users'  ]);
        $data = User::find($req->id);
        $data->email = $req->email;
        $data -> save();
        Alert::success('Success', 'Your Email has changed!');
        return redirect('/dashboard');
    }
}
