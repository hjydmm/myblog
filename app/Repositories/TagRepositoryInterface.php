<?php


namespace App\Repositories;


interface TagRepositoryInterface
{
    public function getTagList($where = null);
}