<?php
namespace App\Repositories\Books;

interface BookRepositoryInterface
{
    public function getNonePaginate();

    public function getBorrowPaginate();

    public function getViewPaginate();

    public function getPaginate();

    public function getWherePaginate($key, $value);

    public function getWhere($key, $value);

    public function getIdAuthor($id);

    public function trashed();

    public function trashedFind($id);

    public function getWhereTrashed($key, $value);

    public function getWithTrashed();

    public function deleteForce($id);
}