<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Vote;
use App\Models\Election;
use Illuminate\Http\Request;

class ResultHandler extends Controller
{
    public function __construct() {}
    public function getUserTotal()
    {
        $users = User::all();
        return $users -> count();
    }
    public function getVoteTotal()
    {
        $votes = Vote::all();
        return $votes -> count();
    }
    public function getElectionTotal()
    {
        $elections = Election::all();
        return $elections -> count();
    }
}
