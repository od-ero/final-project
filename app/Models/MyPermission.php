<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MyPermission extends Model
{   
    use HasFactory;
    use SoftDeletes;
	protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'permission_group_id',
        'permissioner_id',
        'start_date',
        'end_date',
        'frequency',
    ];
}
