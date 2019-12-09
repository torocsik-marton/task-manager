<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name', 'email', 'password',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password', 'remember_token',
        ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    protected $appends = ['permission_list'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function permissions()
    {
        return $this->hasManyDeep(
            Permission::class,
            ['role_user', Role::class, 'permission_role']
        );
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function uncompletedTasks()
    {
        return $this
            ->hasMany(Task::class)
            ->where('completed', 0);
    }


    public function getPermissionListAttribute() {
        return $this
            ->permissions()
            ->get(['permission'])
            ->pluck('permission')
            ->toArray();
    }
}
