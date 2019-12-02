<?php


namespace App\Repositories;


interface AuthRepositoryInterface
{
    public function getChildAuthByIds(array $ids);
}