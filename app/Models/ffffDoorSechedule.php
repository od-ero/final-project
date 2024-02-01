<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoorSechedule extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
        'door_id',
        'open_in',
        'close_in',
        'open_out',
        'close_out',
        'start_date',
        'end_date',
        'user_id',
        'open_in_fre',
        'close_in_fre',
        'open_out_fre',
        'close_out_fre',
        'door_sechedule_permission_id',
       
    ];
}
