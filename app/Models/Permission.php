<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
       
        'permission_group_id',
        'door_id',
        'give_permission',
        'open',
        'close',
        'schedule',
        'give_permission_fre',
        'open_fre',
        'close_fre',
        'schedule_fre',
    ];
}
