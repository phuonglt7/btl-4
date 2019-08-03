<?php
namespace App\Repositories\Users;

interface UserRepositoryInterface
{
    public function paginateUser();

    public function findPivot($id);

    public function updateUser($id, array $attributes);
}