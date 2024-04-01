<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DoorIp extends Model
{
    use HasFactory;
   
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
        'door_id',
        'ip_address',
        'door_ip_status',
    ];
}
