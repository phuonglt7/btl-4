<?php
namespace App\Repositories\Authors;

interface AuthorRepositoryInterface
{
    public function getPaginate();

    public function getAll();

    public function getWhere($key, $value);

    public function create(array $value);

    public function trashed();

    public function trashedFindAuthor($id);

    public function getWithTrashed();

    public function deleteForce($id);
}