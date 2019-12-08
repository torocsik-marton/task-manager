<?php
/**
 * Created by PhpStorm.
 * User: martontorocsik
 * Date: 2019. 12. 08.
 * Time: 22:49
 */

namespace App\Services;


use App\User;

class PermissionService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function userHasPermission($permission) {
        $permission_list = $this->user
            ->getPermissionList()
            ->toArray();

        return (in_array($permission, $permission_list));
    }
}