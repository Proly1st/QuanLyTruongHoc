<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeKeeping extends Model
{
    //
    protected $table = 'timekeeping';
    protected $primaryKey = 'id';

    public function branch()
    {
        return $this->hasOne('App\Models\Branches','id','school_id');
    }
}
