<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoorSchedulePermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'permission_name',
        'open_in',
        'close_in',
        'open_out',
        'close_out',
        'open_in_fre',
        'close_in_fre',
        'open_out_fre',
        'close_out_fre',
        'user_id',
       
       
    ];
}
