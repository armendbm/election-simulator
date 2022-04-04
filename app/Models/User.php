<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function own_elections()
    {
        return $this->hasMany(Election::class, 'owner_id');
    }

    public function participant_elections()
    {
        return $this->belongsToMany(Election::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
