<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPermission extends Model
{
    use HasFactory;
    protected $table = "users_permissions";

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //relacion uno muchos
    public function user()  {
        return $this->belongsTo(User::class);
    }

    public function permission(){
        return $this->belongsTo(Permission::class);
    }
}
