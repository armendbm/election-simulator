<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *  Vote Schema:
 *      Vote -> [id, data, user_id, election_id, created_at, updated_at]
 *          id          -> unique vote id integer
 *          user_id     -> unique id SQL index of the user who casted the vote
 *          election_id -> unique id SQL index of the election to which this vote relates
 *          created_at  -> time id for when the vote was cast in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 *          updated_at  -> time id for the last time the vote was edited in the form Y/M/D Time eg. "2022-03-01 14:59:59"
 */

class Vote extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}
