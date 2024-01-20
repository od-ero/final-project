<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MyPermission_counter extends Model
{
    use HasFactory;
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
        'my_permission_id',
        'door_id',
        'give_permission',
        'open',
        'close',
        'schedule',
    ];
}
