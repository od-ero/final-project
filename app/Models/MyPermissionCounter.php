<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MyPermissionCounter extends Model
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
