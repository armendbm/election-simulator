<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResultHandler;
use App\Http\Controllers\VoteHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VoteHandler extends Controller
{
    public function createElection($OwnerID, $StartTime, $EndTime)
    {
        $ElectionController = new ElectionController();
        $election = $ElectionController->create($OwnerID, $StartTime, $EndTime);
        DB::table('elections')->insert($election);
    }
}
