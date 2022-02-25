<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class result_handler extends Controller
{
    public function __construct() {}
    public function getVoteTotal()
    {
        $users = User::all();
        return $users -> count();
    }
}
