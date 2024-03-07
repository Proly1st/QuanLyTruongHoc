<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffJobBranch extends Model
{
    //
    protected $dates = ['deleted_at'];
    protected $table = 'Staff_job_branch';
    protected $primaryKey = 'id';
}
