<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoorScheduleCounter extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
        'door_schedule_door_id',
        'open_in',
        'close_in',
        'open_out',
        'close_out',
    ];
}
