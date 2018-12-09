<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\User;

class Role extends Model
{
    //
    protected $connection = 'main';

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')->withTimestamps();
    }
}
